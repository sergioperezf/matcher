# Matcher

This is a Laravel application implementing a matcher between agents and contacts based on Zip Code. 

## Installation

To install the application, ensure that `composer` is installed and run `composer install`. Composer will take care of alerting you if any PHP dependencies are not present.

For the front end, install `nodejs`and `npm`. Once they are installed, run `npm install` from the root directory.

## Configuration

First, copy the file `.env.example` to `.env` in the root directory. At the bottom of this file, replace your Google Maps API key, and tweak the rest of the file according to the environment.

Make sure the webserver has write access to the `storage` directory.

This app comes with `predis` listed as a dependency, so using Redis as a cache driver is just a matter of coniguring it in the `.env` file.

## 3rd Party components

This project makes use of a number of 3rd party libraries:

- `dotzero/gmaps-geocode`: the project uses this libraries to communicate with the Google Maps API for geolocalization of zip codes. *Althought the Google Maps API will be used to retrieve zip coordinates, many of the coordinates are already in a file calle codes.csv, and all of them are cached after retrieval.*
- `uvinum/zipcodevalidator`: used to validate zip codes entered by the user.
- `bdelespierre/php-kmeans`: this is the main library used to match the agents to the contacts. An extension was made to it in order to adapt it to the needs, but at its core the matching is perfomed based on the K-means clustering algorithm.
- `predis/predis`: used in case we want to use redis as the cache driver.

## Front-end

To build the front-end assets use `npm run <script>`, where `<script>` is the desired environment, `dev` or `prod`.

Running `npm run watch` will set up a watcher that will re-build the assets everytime a file changes.