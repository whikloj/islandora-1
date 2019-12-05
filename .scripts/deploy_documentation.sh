#!/bin/bash
# To avoid all of this for pull request travis-ci runs.

git clone https://github.com/Islandora/documentation.git $HOME/islandora
pip install mkdocs
pip install mkdocs-material
cd $HOME/islandora
mkdocs build --clean
