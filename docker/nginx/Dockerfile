FROM nginx:alpine

MAINTAINER Mina Sami <mina.nsami@gmail.com>

RUN apk update \
    && apk add git curl vim wget bash acl

ADD nginx.conf /etc/nginx/

# set right permissions for symfony cache
RUN HTTPDUSER=$(ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1)
RUN setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var
RUN setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var

