const { render } = wp.element;
import App from "./components/App";

if (document.getElementById("pkwcdc-settings-root")) {
  render(<App />, document.getElementById("pkwcdc-settings-root"));
}
