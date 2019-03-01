// ver alojamiento Component

class VerAlojamiento extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      alojamiento: [],
      bd: [],
      listHost: [],
      estados: []
    }

    this.handlePedirPassword = this.handlePedirPassword.bind(this);
    this.handlePedirBd = this.handlePedirBd.bind(this);
  }

  handlePedirPassword() {
    // Funcion para pedir un nuevo password
    let hostLocation = window.location.hostname;

    if (confirm('¿Estas seguro de querer generar una nueva contraseña?\r\n\r\nLa anterior dejara de funcionar. Recibiras  la nueva por correo electronico.')) {
      // Si quiere
      fetch('http://'+ hostLocation +'/index.php/ws/nuevoPassword', {
        method: 'POST',
        header: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({id: this.state.alojamiento[0].id})
      })
      .then((respuesta) => respuesta.json())
      .then((respuestajson) => {

      })
      .catch((error) => {
        alert('Ha habido un error!. Error PPx01');
        throw 'Ha habido un error al pedir el password: '+ error;
      });
    } else {
      // No quiere
    }
  }

  handlePedirBd() {
    // Funcion para pedir una BD
    let hostLocation = window.location.hostname;

    if(confirm('¿Estas seguro de querer pedir una base de datos?\r\n\r\nSe creara una base de datos MySQL y recibiras un correo con los datos de la base de datos')) {
      // Si quiere BD
      fetch('http://'+ hostLocation +'/index.php/ws/nuevaBD', {
        method: 'POST',
        header: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({id: this.state.alojamiento[0].id})
      })
      .then((respuesta) => respuesta.json())
      .then((respuestajson) => {

      })
      .catch((error) => {
        alert('Ha habido un error!. Error PBDx01');
        throw 'Ha habido un error al pedir una base de datos: '+ error;
      });
    } else {
      // Va a ser que se ha dado cuenta que no
    }
  }

  componentWillMount() {
    // Sacamos el ID de la URL
    let idAlojamiento = SacaID(window.location.pathname);
    let hostLocation = window.location.hostname;

    // Lo cargamos los datos del alojamiento
    fetch('http://'+ hostLocation +'/index.php/ws/datosalojamiento/'+ idAlojamiento)
      .then((respuesta) => respuesta.json())
      .then((respuestajson) => {
        this.setState({
          alojamiento: respuestajson.alojamiento
        });
      })
      .catch((error) => {
        alert('Ha habido un error.\r\n¿Esta usted logeado en la plataforma?\r\n¿Es este alojamiento de su propiedad?\r\n\r\nPruebe a recargar la pagina. Error v01x01');
        throw 'Error en el fetch. Error: '+error;
      });

    // Los datos de la bd
    fetch('http://'+ hostLocation + '/index.php/ws/datosBD/'+ idAlojamiento)
      .then((respuesta) => respuesta.json())
      .then((respuestajson) => {
        this.setState({
          bd: respuestajson.bd
        })
      })
      .catch((error) => {
        alert('Ha habido un error.\r\n¿Esta usted logeado en la plataforma?\r\nPruebe a recargar la pagina. Error v01x02');
        throw 'Error en el fetch. Error: '+error;
      });

    // La lista de Hosts y los estados ahi, todos juntos, a la burro...
    fetch('http://'+ hostLocation + '/index.php/ws/devuelveHosts')
      .then((respuesta) => respuesta.json())
      .then((respuestajson) => {
        this.setState({
          listHost: respuestajson.hosts
        });
      })
      .catch((error) => {
        alert('Ha habido un error.\r\n¿Esta usted logeado en la plataforma?\r\nPruebe a recargar la pagina. Error v01x03');
        throw 'Error en el fetch. Error: '+error;
      });

      // Sacamos los estados
      fetch('http://'+ hostLocation + '/index.php/ws/devuelveTodosEstados')
        .then((respuesta) => respuesta.json())
        .then((respuestajson) => {
          this.setState({
            estados: respuestajson.estados
          })
        })
        .catch((error) => {
          alert('Ha habido un error.\r\n¿Esta usted logeado en la plataforma?\r\nPruebe a recargar la pagina. Error Error v01x04');
          throw 'Error en el fecth: '+ error;
        });
  }

  render() {
    // Render render que es lo que les j*de

    // Fragmento React
    let Fragment = React.Fragment;

    // Los datos del alojamiento
    let id, host, hostid, user, responsable, emailContacto, ip, idestado, url, alias, fechaPeticion, fechaRealizacion, descripcion, estadoid, estado, basedatos;
    if (this.state.alojamiento[0] !== undefined) {
      id = this.state.alojamiento[0].id;
      hostid = this.state.alojamiento[0].host;
      user = this.state.alojamiento[0].user;
      responsable = this.state.alojamiento[0].responsable;
      emailContacto = this.state.alojamiento[0].emailContacto;
      ip = this.state.alojamiento[0].ip;
      url = this.state.alojamiento[0].url;
      alias = this.state.alojamiento[0].alias;
      fechaPeticion = this.state.alojamiento[0].fechaPeticion;
      fechaRealizacion = this.state.alojamiento[0].fechaRealizacion;
      descripcion = this.state.alojamiento[0].descripcion;
      estadoid = this.state.alojamiento[0].idestado;
      basedatos = this.state.alojamiento[0].basedatos;
    }

    // Los datos de la base de datos
    let bdId, hostBd, userBd, basededatosBd;
    let returnBd;
    if (this.state.bd[0] !== undefined) {
      bdId = this.state.bd[0].id;
      hostBd = this.state.bd[0].host;
      userBd = this.state.bd[0].user;
      basededatosBd = this.state.bd[0].basededatos;

      returnBd =
          <Fragment>
            <hr className="separadorBd"/>
            <h2>Datos de la base de datos</h2>
            <table className="table">
              <tr>
                <td><strong>Host de la base de datos</strong></td>
                <td>{hostBd}</td>
              </tr>
              <tr>
                <td><strong>Nombre de la base de datos</strong></td>
                <td>{basededatosBd}</td>
              </tr>
              <tr>
                <td><strong>Usuario de la base de datos</strong></td>
                <td>{userBd}</td>
              </tr>
            </table>
            <button onClick={this.handlePedirPasswordBd} className="btn btn-light">Pedir nueva contrase&ntilde;a</button>
          </Fragment>;
    } else {
      returnBd =
        <Fragment>
          &nbsp;<button onClick={this.handlePedirBd} className="btn btn-light"><i className="fas fa-database margin-right-05"></i>Pedir una Base de Datos</button>
        </Fragment>
    }

    // Host donde esta alojado
    if (this.state.listHost.length > 0) {
      host = this.state.listHost.filter((elemento) => elemento.id == hostid);
      if (host[0] != undefined) {
        host = host[0].hostName;
      }
    }

    // Devuelve el estado del alojamiento (se puede y debe refactorizar)
    let estadotmp = this.state.estados.filter((estado) => {
      return estado.id == estadoid;
    });

    estado = estadotmp.map((elemento) => {
      return elemento.estado;
    });

    return(
      <Fragment>
        <h2>Datos del alojamiento</h2>
        <table className="table">
          <tbody>
            <tr>
              <td><strong>Host donde esta alojado</strong></td>
              <td>{host}</td>
            </tr>
            <tr>
              <td><strong>Usuario</strong></td>
              <td>{user}</td>
            </tr>
            <tr>
              <td><strong>Email de Contacto</strong></td>
              <td>{emailContacto}</td>
            </tr>
            <tr>
              <td><strong>NIF del Responsable</strong></td>
              <td>{responsable}</td>
            </tr>
            <tr>
              <td><strong>IPs permitidas</strong></td>
              <td>{ip}</td>
            </tr>
            <tr>
              <td><strong>Estado del alojamiento</strong></td>
              <td>{estado}</td>
            </tr>
          </tbody>
        </table>
        <button onClick={this.handlePedirPassword} className="btn btn-light">Pedir nueva contrase&ntilde;a</button>
        &nbsp;
        <button onClick={this.handlePedirPassword} className="btn btn-light">Pedir aumento de espacio en disco</button>
        &nbsp;
        <button onClick={this.handlePedirPassword} className="btn btn-light">Otras peticiones</button>
        {returnBd}
      </Fragment>
    );
  }
}

ReactDOM.render(<VerAlojamiento />, document.getElementById("verAlojamiento"));

function SacaID(texto) {
  // Funcion sencillisima recursiva que busca un id de un string
  let stringParse = texto.split('/');

  if (parseInt(stringParse[(stringParse.length - 1)]) !== NaN) {
    // Si es un numero, lo retornamos
    return stringParse[(stringParse.length - 1)];
  } else {
    // Sino, eliminamos ese item
    stringParse.splice(-1,1);
    // Lo hacemos un string y volvemos a ejecutar esto
    sacaID(stringParse.join('/'));
  }

  return false;
}
