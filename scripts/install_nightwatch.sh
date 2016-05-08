#!/bin/bash
# Script to install nightwatch and selenium server.

# Install nightwatch
npm install -g nightwatch

# Downlod the selenium server
wget http://selenium-release.storage.googleapis.com/2.53/selenium-server-standalone-2.53.0.jar -P bin/
