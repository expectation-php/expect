#!/bin/sh

# Get ApiGen.phar
wget http://www.apigen.org/apigen.phar
chmod +x apigen.phar

# Generate Api
php apigen.phar generate
cd ../gh-pages

# Set identity
git config --global user.email "holy.shared.design@gmail.com"
git config --global user.name "Noritaka Horio"

# Add branch
git init
git remote add origin https://${GH_TOKEN}@github.com/expectation-php/expect.git > /dev/null
git checkout -B gh-pages

# Push generated files
git add .
git commit -m "API updated"
git push origin gh-pages -fq > /dev/null
