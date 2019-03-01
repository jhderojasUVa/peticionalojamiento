// New alojamiento Component

class AlojamientoNew extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      host: '',
      listHost: [],
      user: '',
      password: '',
      responsable: '',
      emailContacto: '',
      ip: '*',
      idestado: 0,
      url: '.uva.es',
      alias: '',
      fechaPeticion: Date.now(),
      descripcion: '',
      verPassword: false,
      inputType: 'password',
      resultado: false
    }

    this.handleUser = this.handleUser.bind(this);

    this.handleShowPassword = this.handleShowPassword.bind(this);
    this.randomPassword = this.randomPassword.bind(this);

    this.handleChangePassword = this.handleChangePassword.bind(this);

    this.handleChangeHost = this.handleChangeHost.bind(this);

    this.handleChangeEmail = this.handleChangeEmail.bind(this);

    this.handleChangeIP = this.handleChangeIP.bind(this);

    this.handleChangeUrl = this.handleChangeUrl.bind(this);

    this.handleChangeAlias = this.handleChangeAlias.bind(this);

    this.handleChangeDescripcion = this.handleChangeDescripcion.bind(this);

    this.handleNextStep = this.handleNextStep.bind(this);

    this.handleForm = this.handleForm.bind(this);
  }

  handleUser(event) {
    event.preventDefault();
    this.setState({user: event.target.value});
  }

  handleShowPassword(event) {
    // Encargado de mostrar/ocultar password
    event.preventDefault();
    // Esto se puede refatorizar pero ahora a la larga
    if (this.state.verPassword == false) {
      this.setState({
        verPassword: true,
        inputType: 'text'
      });
    } else {
      this.setState({
        verPassword: false,
        inputType: 'password'
      });
    }
  }

  randomPassword() {
    // Generador aleatorio de passwords 'basico'
    let randomString = Math.random().toString(36).slice(-12);
    this.setState({
      password: randomString
    });
  }

  handleChangePassword(event) {
    this.setState({
      password: event.target.value
    });
  }

  handleChangeHost(event) {
    this.setState({
      host: event.target.value
    })
  }

  handleChangeEmail(event) {
    this.setState({
      emailContacto: event.target.value
    });
  }

  handleChangeIP(event) {
    this.setState({
      ip: event.target.value
    });
  }

  handleChangeUrl(event) {
    this.setState({
      url: event.target.value
    });
  }

  handleChangeAlias(event) {
    this.setState({
      alias: event.target.value
    });
  }

  handleChangeDescripcion(event) {
    this.setState({
      descripcion: event.target.value
    });
  }

  handleNextStep(event) {
    // Como se supone que ya ha pasado por todo, deberia de estar correcto... ¿verdad? ¿verdad?
    // ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad?
    fetch('http://peticionalojamientos.uva.es/index.php/ws/addalojamiento', {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(this.state)
    })
    .then((respuesta) => {
      console.log(respuesta);
      respuesta.json();
    })
    .then((respuestajson) => {
      console.log(respuestajson);
      this.setState({resultado: respuestajson});
      alert('¡Gracias!\r\nSu petición de alojamiento ha sido realizada. Nos pondremos en contacto con usted.');
      window.location.href = 'http://peticionalojamientos.uva.es/index.php/principal/login';
    })
    .catch((error) => {
      alert('Lo sentimos.\r\nHa habido un error al hacer la peticion');
      throw 'Error envio peticion ExP01: '+ error;
    });

    return false;
  }

  handleForm(event) {
    event.preventDefault();
    return false;
  }

  componentWillMount() {
    // Cosas a hacer en el arranque

    // Cargar los hosts que tenemos y los ponemos en su sitio (del 'ojeto')
    fetch('http://peticionalojamientos.uva.es/index.php/ws/devuelveHosts')
      .then((respuesta) => respuesta.json())
      .then((respuestajson) => {
        let host = respuestajson.hosts.filter((elemento) => {
          if (elemento.hostName == 'albergueweb1.uva.es') { return elemento.id; }
        });
        this.setState({
          responsable: respuestajson.usuario,
          listHost: respuestajson.hosts
        });
        this.setState({
          host: host[0].id
        })
      })
      .catch((error) => {
        alert('Ha habido un error.\r\n¿Esta usted logeado en la plataforma?\r\nPruebe a recargar la pagina');
        throw 'Error en el fetch. Error: '+error;
      });
  }

  render() {
    // Fragmento React
    let Fragment = React.Fragment;

    // Para ver el password (esto se puede refactorizar, pero por ahora a la larga para verlo)
    let verPassword;
    if (this.state.verPassword == false) {
      verPassword = <i className="far fa-eye"></i>;
    } else {
      verPassword = <i className="fas fa-eye-slash"></i>;
    }

    // La lista de Hosts (se puede refactorizar en cliente o en servidor para los permitidos)
    let Hosts = this.state.listHost.map((elemento) => {
      if (elemento.hostName == 'albergueweb1.uva.es') {
        return <option selected="selected" value={elemento.id}>{elemento.hostName}: {elemento.descripcion}</option>
      } else {
        // Aunque tenemos un active (true, false) en principio solo les vamos a dejar pedir en uno solo
        return <option value={elemento.id} disabled>{elemento.hostName}: {elemento.descripcion}</option>
      }
    });

    let hostName = this.state.listHost.filter((elemento) => {
      return elemento.id == this.state.host;
    });

    let hostAlias;
    if (hostName[0]) {
      hostAlias = 'http://' + hostName[0].hostName + '/' + this.state.alias;
    } else {
      hostAlias = 'http://albergueweb1.uva.es/' + this.state.alias;
    }

    let divResultado;
    if (this.state.resultado == true) {
      divResultado = <div className="resultado"><h2>Alojamiento creado</h2><p>Hemos recibido su alojamiento y esta en proceso.</p></div>;
    }

    return (
      <Fragment>
        {divResultado}
        <div className="">
          <form noValidate onClick={this.handleForm}>
            <div className="form-group">
              <label htmlFor="usuarioText"><strong>Nombre de usuario</strong></label>
              <input type="text" required="required" className="form-control" id="usuarioText" aria-describedby="usuarioTextHelp" placeholder="Nombre de usuario" onChange={this.handleUser} value={this.state.user}/>
              <small id="usuarioTextHelp" className="form-text text-muted">Su nombre de usuario no se puede cambiar una vez creada la petición de alojamiento.</small>
            </div>
            <div className="form-group">
              <label htmlFor="passwordText"><strong>Password</strong> <a onClick={this.handleShowPassword} aria-label="Mostrar contraseña">{verPassword}</a> <a onClick={this.randomPassword}><i className="fas fa-random"></i></a></label>
              <input type={this.state.inputType} required="required" className="form-control" id="passwordText" aria-describedby="PasswordTextHelp" value={this.state.password} onChange={this.handleChangePassword} />
              <small id="PasswordTextHelp" className="form-text text-muted">Escriba su password. Pulse sobre el ojo ({verPassword}) para mostrarlo/ocultarlo. Pulse en aleatorio (<i className="fas fa-random"></i>) para crear uno aleatorio <strong>altamente seguro</strong>.</small>
            </div>
            <div className="form-group">
              <label htmlFor="Hosts"><strong>Donde quiere su alojamiento</strong></label>
              <select className="form-control" id="Hosts" aria-describedby="HostsHelp" onChange={this.handleChangeHost}>
                {Hosts}
              </select>
              <small id="HostsHelp" className="form-text text-muted">Seleccione donde quiere crear su alojamiento.</small>
            </div>
            <div className="form-group">
              <label htmlFor="responsableText"><strong>Responsable</strong></label>
              <input type="text" disabled="disabled" className="form-control" id="responsableText" aria-describedby="responsableTextHelp" value={this.state.responsable} />
              <small id="responsableTextHelp" className="form-text text-muted">Identificador del responsable del alojamiento. Persona que realiza la petición. <strong>No se puede cambiar</strong>.</small>
            </div>
            <div className="form-group">
              <label htmlFor="emailText"><strong>Dirección de Email de Contacto</strong></label>
              <input type="email" required="required" className="form-control" id="emailText" aria-describedby="emailTextHelp" value={this.state.emailContacto} onChange={this.handleChangeEmail} />
              <small id="emailTextHelp" className="form-text text-muted">Direccion de correo donde se recibiran la información del alojamiento. <strong>Todo intercambio de información se hara en esta dirección de correo</strong>.</small>
            </div>
            <div className="form-group">
              <label htmlFor="IPsText"><strong>Direcciones IPs permitidas</strong></label>
              <input type="text" required="required" className="form-control" id="IPsText" aria-describedby="IPsTextHelp" value={this.state.ip} onChange={this.handleChangeIP} />
              <small id="IPsTextHelp" className="form-text text-muted">Direcciones IPs que tendran permiso para acceder a los ficheros <strong>separadas por comas</strong> (157.88.12.111, 157.88.23.41).<br/><strong>*</strong> - cualquier IP<br/>Por defecto se permite cualquier IP.</small>
            </div>
            <div className="form-group">
              <label htmlFor="URLText"><strong>URL del alojamiento</strong> http://{this.state.url}</label>
              <input type="text" className="form-control" id="URLText" aria-describedby="URLTextHelp" placeholder="estoesunejemplo.uva.es" value={this.state.url} onChange={this.handleChangeUrl} />
              <small id="URLTextHelp" className="form-text text-muted">Nombre/DNS o URL del alojamiento que desea. <strong>Si no quiere ninguno dejelo por defecto</strong>.</small>
            </div>
            <div className="form-group">
              <label htmlFor="AliasText"><strong>Alias del alojamiento</strong> {hostAlias}</label>
              <input type="text" required="required" className="form-control" id="AliasText" aria-describedby="AliasTextHelp" placeholder="estoesunejemplo" value={this.state.alias} onChange={this.handleChangeAlias} />
              <small id="AliasTextHelp" className="form-text text-muted">El alias sera creado automaticamente justo a la URL del alojamiento.</small>
            </div>
            <div className="form-group">
              <label htmlFor="DescripcionTextArea"><strong>Descripción de contenidos</strong></label>
              <textarea aria-describedby="AliasTextHelp" className="form-control" id="DescripcionTextArea" value={this.state.descripcion} onChange={this.handleChangeDescripcion}></textarea>
              <small id="DescripcionTextAreaHelp" className="form-text text-muted">Indique, brevemente, que contendra el alojamiento (técnica y contenido).</small>
            </div>
          </form>
          <button className="btn btn-light" onClick={this.handleNextStep}>Realizar petición de alojamiento</button>
        </div>
      </Fragment>
    );
  }

}

ReactDOM.render(<AlojamientoNew />, document.getElementById("nuevoAlojamiento"));
