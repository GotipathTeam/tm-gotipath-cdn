FROM openresty/openresty:1.19.9.1-2-bionic

RUN apt-get update && apt-get install git -y
RUN git config --global url."https://".insteadOf git:// && \
    git config --global advice.detachedHead false && \
    luarocks install lua-resty-phantom-token