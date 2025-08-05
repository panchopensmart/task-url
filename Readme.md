### Запуск проекта
_*Перед запуском нужно переименовать .env.example -> .env_

1. **Запуск контейнеров:**
   ```bash
   docker compose up --build -d
2. **Запустить установку пакетов:**
   ```bash
   docker exec -it app bash -c "composer install"
3. **Выдать все права на контейнер с приложением**
   ```bash
   docker exec -it app bash -c "chmod -R 777 ./"
   
Запрос для аналитики
```sql
SELECT
  to_char(c.created_at, 'YYYY-MM') AS month,
  u.original_url AS link,
  COUNT(*) AS clicks,
  RANK() OVER (PARTITION BY to_char(c.created_at, 'YYYY-MM') ORDER BY COUNT(*) DESC) AS position
FROM click c
JOIN url u ON u.id = c.url_id
GROUP BY month, u.original_url
ORDER BY month DESC, clicks DESC;
