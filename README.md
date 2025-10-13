## run migrate
php artisan migrate:fresh --seed

## run queue
php artisan queue:work rabbitmq --queue=fila_falha_enviar_email,fila_email,fila_busca_cep
