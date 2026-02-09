import { useState } from "react";

/**
 * A description of the "core/ajax" Moodle library. This is only a partial
 * description. See the JSDocs in lib/amd/src/ajax.php for more details.
 */
interface MoodleAjax {
  call(
    requests: Array<{
      methodname: string;
      args: Record<string, string>;
    }>,
  ): Promise<any>[];
}

function App(props: { ajax: MoodleAjax }) {
  const [prefs, setPrefs] = useState<
    Array<{
      name: string;
      value: string;
    }>
  >([]);

  return (
    <>
      <h1>Moodle + Vite + React</h1>
      <div className="card">
        <button
          onClick={() => {
            // An example of calling a Moodle webservice via core/ajax.
            // For more details see: https://moodledev.io/docs/5.0/guides/javascript/ajax
            props.ajax
              .call([
                // This is one of Moodle's built-in webservices. The plugin
                // could also define its own custom webservices and use those.
                // For more on that see: https://moodledev.io/docs/5.0/apis/subsystems/external/writing-a-service
                { methodname: "core_user_get_user_preferences", args: {} },
              ])[0]
              .then(({ preferences }) => setPrefs(preferences));
          }}
        >
          Press me
        </button>
        <p>Press the button to load data from Moodle webservice</p>
      </div>
      <dl>
        {prefs.map((p) => (
          <>
            <dt>{p.name}</dt>
            <dd>{p.value}</dd>
          </>
        ))}
      </dl>
    </>
  );
}

export default App;
