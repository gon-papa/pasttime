FROM node:16.13.0-alpine3.13 

WORKDIR /app
RUN apk update && \
    apk upgrade && \
    apk add --no-cache make gcc g++ python3 && \
    yarn install