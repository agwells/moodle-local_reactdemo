import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
// import "./index.css";
import App from "./App.tsx";

function init(ajax: any) {
  createRoot(document.getElementById("root")!).render(
    <StrictMode>
      <App ajax={ajax} />
    </StrictMode>,
  );
}

// This is a quick and hacky way to "export" the init function so
// it can be called by Moodle's JS initialization.
//
// If you can set up the build chain to compile to AMD (or maybe
// CommonJS) then you could probably do this more cleanly by simply telling
// Moodle to import the React app as an AMD module.
// @ts-expect-error
window.local_reactdemo_init = init;
