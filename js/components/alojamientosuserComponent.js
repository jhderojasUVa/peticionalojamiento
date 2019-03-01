// New alojamiento Component

class AlojamientosUser extends React.Component {
  // Componente que muestra los alojamientos de un usuario
  constructor(props) {
    super(props);
    this.state = {
      alojamientos: [],
      estados: []
    }

    this.handleChangePassword = this.handleChangePassword.bind(this);
    this.handleDelete = this.handleDelete.bind(this);
  }

  handleChangePassword() {
    // Para cuando el usuario quiere cambiar el password
  }

  handleDelete() {
    // Para cuando el usuario quiere eliminar el alojamiento
    if (confirm('¿Estas seguro de querer eliminar el alojamiento?\r\n\r\nSe eliminaran todos los datos que contiene y sus bases de datos.\r\nEsto no tiene vuelta atras.')) {
      console.log('El vera, luego que no llore.');
    } else {
      console.log('Ha hecho bien.');
    }
  }

  componentWillMount() {
    // Cosas a hacer en el arranque
    // Como por ejemplo rellenar los estados del componente

    // Sacamos los alojamientos que tiene la persona
    fetch('http://peticionalojamientos.uva.es/index.php/ws/devuelveTodosAlojamientosPersona')
      .then((respuesta) => respuesta.json())
      .then((respuestajson) => {
        this.setState({
          alojamientos: respuestajson.alojamientosUsuario
        });
      })
      .catch((error) => {
        alert('Ha habido un error.\r\n¿Esta usted logeado en la plataforma?\r\nPruebe a recargar la pagina');
        throw 'Error en el fecth: '+ error;
      });

      // Sacamos los estados
      fetch('http://peticionalojamientos.uva.es/index.php/ws/devuelveTodosEstados')
        .then((respuesta) => respuesta.json())
        .then((respuestajson) => {
          this.setState({
            estados: respuestajson.estados
          })
        })
        .catch((error) => {
          alert('Ha habido un error.\r\n¿Esta usted logeado en la plataforma?\r\nPruebe a recargar la pagina');
          throw 'Error en el fecth: '+ error;
        });
  }

  render() {
    // Renderizamos

    // Fragmento React
    let Fragment = React.Fragment;

    let alojamientos = <tr><td colSpan="7">No se han encontrado alojamientos</td></tr>;
    if (this.state.alojamientos.length > 0) {
      alojamientos = this.state.alojamientos.map((elemento, index) => {
        console.log(elemento);
        //let fechaPeticion = new Date(Date.parse(elemento.fechaPeticion.replace('-', '/', 'g')));
        //let fechaRealizacion = new Date(Date.parse(elemento.fechaRealizacion.replace('-', '/')));
        var fechaPeticion = arreglaFecha(elemento.fechaPeticion);
        if (elemento.fechaRealizacion) {
          var fechaRealizacion = arreglaFecha(elemento.fechaRealizacion);
        } else {
          var fechaRealizacion = '';
        }

        // Devuelve el estado del alojamiento (se puede y debe refactorizar)
        let estadotmp = this.state.estados.filter((estado) => {
          return estado.id == elemento.idestado;
        });

        let estado = estadotmp.map((elemento) => {
          return elemento.estado;
        });

        let color = estadotmp.map((elemento) => {
          return 'semaforo_' + elemento.color;
        });

        let hayBd;
        let botonBaseDatos;
        if (elemento.basededatos === null) {
          botonBaseDatos = <a className="acciones" onClick={this.handlePedirBd}>Pedir base de datos</a>
        } else {
          hayBd = <i className="fas fa-eye"></i>;
          botonBaseDatos = <a className="acciones_disabled">Pedir base de datos</a>
        }
        //<a className="acciones" onClick={this.handleChangePassword}>Nueva contrase&ntilde;a</a>
        //{botonBaseDatos}
        //<a className="acciones peligro" onClick={this.handleDelete}><i className="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;&nbsp;Eliminar alojamiento</a>

        let verAlojamiento = '/index.php/principal/verDatosAlojamiento/' + elemento.id;

        return (
          <tr key={index}>
            <td><a href={'http://' + elemento.url} target="_blank">{elemento.url}</a></td>
            <td>{elemento.alias}</td>
            <td>{elemento.user}</td>
            <td>{fechaPeticion.toString()}</td>
            <td>{fechaRealizacion.toString()}</td>
            <td>{hayBd}</td>
            <td><span className={color} title={estado}></span>&nbsp;<small className="definicion">{estado}</small></td>
            <td>
              <a className="acciones" href={verAlojamiento}>Ver datos&nbsp;&nbsp;<i className="fas fa-arrow-circle-right"></i></a>
            </td>
          </tr>
        );
      });
    }

    return (
      <Fragment>
        <table className="table">
          <thead>
            <tr>
              <th scope="col">URL</th>
              <th scope="col">Alias</th>
              <th scope="col">Usuario</th>
              <th scope="col">Peticion</th>
              <th scope="col">Realizaci&oacute;n</th>
              <th scope="col">BD</th>
              <th scope="col">Estado</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            {alojamientos}
          </tbody>
        </table>
      </Fragment>
    );
  }
}

ReactDOM.render(<AlojamientosUser />, document.getElementById("alojamientosuser"));

function arreglaFecha(fecha) {
  let fechatmp = fecha.split('-');
  return fechatmp[2] + '/' + fechatmp[1] + '/' + fechatmp[0];
}
