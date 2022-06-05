FROM node:16.13.0-alpine3.13 

WORKDIR /app
RUN apk update && \
    apk upgrade && \
    apk add --no-cache make gcc g++ python3 && \
    yarn install
COPY ./frontend/package.json ./frontend/package-lock.json ./
RUN npm install && \
    npm install pm2 -g && \
    npm run build

CMD ["node_modules/pm2/bin/pm2", "--no-daemon", "start", "npm -- start"]