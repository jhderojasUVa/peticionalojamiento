// email consultas Component

class ConsultaGente extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      asunto: '',
      texto: '',
      enviado: false
    }

    this.handleSendEmail = this.handleSendEmail.bind(this);
  }

  handleSendEmail() {
    // Metodo del boton de enviar correo
    let idAlojamiento = SacaID(window.location.pathname);
    let hostLocation = window.location.hostname;

    fetch('http://'+ hostLocation +'/index.php/ws/enviamail/'+ idAlojamiento)
      .then((respuesta) => respuesta.json())
      .then((respuestajson) => {
        if (respuestajson.respuesta == true) {
          this.setState({ enviado: true });
        }
      })
      .catch((error) => {
        alert('Lo sentimos!\r\nAlgo ha fallado, ha habido un error. Error ECx008x1');
        throw 'Error en el envio del correo: '+ error;
      });

  }

  render() {
    // Fragmento React
    let Fragment = React.Fragment;

    if (this.state.enviado == true) {
      return (
          <Fragment>
            <h2>Gracias por enviar tu petici&oacute;n</h2>
            <p>Te contestaremos lo antes posible.</p>
          </Fragment>
      );
    } else {
      return (
          <Fragment>
            <form>
              <div className="form-group">
                <label htmlFor="asuntoInput">Asunto de tu consulta</label>
                <input type="text" className="form-control" id="asuntoInput" aria-describedby="asuntoHelp" required placeholder="Asunto de la consulta (petici&oacute; de espacio, otras peticiones...)" />
                <small id="asuntoHelp" className="form-text text-muted">Escriba el asunto de su consulta, puede ser <strong>aumento de quota</strong>, <strong>problemas de conexi&oacute;n</strong> o cualquier cosa.</small>
              </div>
              <div className="form-group">
                <label htmlFor="textoInput">Texto de su consulta o justificaci&oacute;n</label>
                <textarea className="form-control" id="textoInput" aria-describedby="textoHelp" rows="5"></textarea>
                <small id="textoHelp" className="form-text text-muted">Describa su consulta, intente dar los m&aacute;ximos datos que crea necesarios.</small>
              </div>
            </form>
            <button onClick={this.handleSendEmail} className="btn btn-light">Envianos tu consulta</button>
          </Fragment>
      );
    }
  }
}

ReactDOM.render(<ConsultaGente />, document.getElementById("consultaGente"));

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
