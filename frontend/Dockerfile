FROM node:22.11.0

WORKDIR /frontend
RUN chown -R node:node /frontend 
COPY package*.json ./

RUN npm install

COPY . .

EXPOSE 8080