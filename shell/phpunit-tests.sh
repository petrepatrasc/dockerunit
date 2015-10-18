#!/usr/bin/env bash

mkdir build;
bin/phpunit -c phpunit.xml.dist --testsuite "project";
