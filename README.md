A minimal example of a Moodle plugin that uses a React front-end, and calling
Moodle webservices via "core/ajax" from within React.

## Usage

Install into a Moodle 5.0 site, and visit `/local/reactdemo/index.php`. Click the button to load the current user's preferences via AJAX.

## To do

- Make the join between Moodle and React less hacky by having this compile
  to an AMD module?
- Style the button better.
