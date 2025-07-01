#!/bin/sh
export SRC_DIR=`pwd`;

# Create the database and tables
mysql -u root -h localhost -p'tarifa185' -e "CREATE DATABASE IF NOT EXISTS social_news;"
mysql -u root -h localhost -p'tarifa185' social_news < $SRC_DIR/scripts/sql/create_db.sql