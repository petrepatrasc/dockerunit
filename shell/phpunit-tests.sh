#!/usr/bin/env bash

bin/phpunit -c phpunit.xml.dist --testsuite "project" $@;
