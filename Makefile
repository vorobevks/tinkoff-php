shares-update:
	docker exec -i tinkoff_php php artisan shares:update
shares-stream:
	docker exec -i tinkoff_php php artisan shares:stream