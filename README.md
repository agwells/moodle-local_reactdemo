A minimal example of a Moodle plugin that uses a React front-end, and calling
Moodle webservices via "core/ajax" from within React.

## Usage

Install into a Moodle 5.0 site, and visit `/local/reactdemo/index.php`. Click the button to load the current user's preferences via AJAX.

## Important files

- **index.php**: Has code for instantiating the React app, and injecting Moodle's `core/ajax` as a dependency.
- **react/**: All the React code lives here. Contents are mainly boilerplate from doing `npm create vite@latest my-app -- --template react-ts`
- **react/dist**: Compiled React JS code. (Although this is a build product, the convention with Moodle plugins is to check it into git)
- **react/src/main.tsx**: Entry point for the React app
- **react/src/App.tsx**: React component that invokes Moodle's `core/ajax`
- **react/vite.config.ts**: Slightly modified to generate a `manifestjson` file

## To do

- Make the join between Moodle and React less hacky by having this compile to an AMD module?
- Style the button better.
