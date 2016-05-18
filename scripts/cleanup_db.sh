#!/bin/sh
export SRC_DIR=`pwd`;

mysql -s -u root -h localhost -p'tarifa185' < $SRC_DIR/scripts/sql/cleanup_db.sql
