const { defineConfig } = require('@vue/cli-service')
module.exports =
  defineConfig({
    transpileDependencies: true,
    devServer: {
      port: 8080, // Замените на желаемый порт, например
      webSocketServer: false,
      proxy: {
        '/api': {
          target: 'http://localhost:80', // Адрес вашего бэкенда
          changeOrigin: true, // Чтобы изменить Origin заголовка, если требуется
          secure: false, // Отключить проверку SSL, если используется HTTPS
        },
      },
    }
  })
