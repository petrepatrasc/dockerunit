#!/usr/bin/env bash

mkdir build;
bin/phpunit -c phpunit.xml.dist --testsuite "project" --coverage-text --coverage-clover=build/coverage.clover;
