# Using composer official image is a smart way to avoid installing php and then composer
FROM composer
COPY . /usr/src/apps
WORKDIR /usr/src/apps
CMD [ "tail", "-f", "/dev/null" ]
