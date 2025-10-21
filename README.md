## run migrate
php artisan migrate:fresh --seed

## run queue
php artisan queue:work rabbitmq --queue=busca_cep
php artisan queue:work rabbitmq --queue=fila_falha_enviar_email
php artisan queue:work rabbitmq --queue=fila_email