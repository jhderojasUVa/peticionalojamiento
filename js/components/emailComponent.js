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

            </form>
            <button onClick={this.handleSendEmail}>Envia tu consulta</button>
          </Fragment>
      );
    }
  }
}

ReactDOM.render(<ConsultaGente />, document.getElementById("consultaGente"));
