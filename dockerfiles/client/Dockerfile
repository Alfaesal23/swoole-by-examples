# This Dockerfile is to build Docker image "deminy/swoole-by-examples:client".
# @see https://hub.docker.com/r/deminy/swoole-by-examples
FROM phpswoole/swoole:5.0

RUN \
    set -ex && \
    docker-php-ext-install mysqli && \
    apt-get update && \
    apt-get install -y apache2-utils netcat xxd --no-install-recommends && \
    curl -sfL -o websocat.deb https://github.com/vi/websocat/releases/download/v1.5.0/websocat_1.5.0_ssl1.1_amd64.deb && \
    dpkg -i websocat.deb && \
    rm -rf websocat.deb /var/lib/apt/lists/* && \
    composer require -d ${HOME} -n predis/predis:~1.1.0 && \
    composer clearcache
