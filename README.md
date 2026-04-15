# Authentication setup workspace

Минимальный воспроизводимый bootstrap для локального старта auth-модуля без догадок.

## Самый короткий сценарий запуска

1. Подготовьте локальную базу MySQL:
   - создайте базу `auth_workspace`;
   - проверьте credentials в `.env`.
2. Инициализируйте окружение:

```bash
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

3. Проверьте frontend и поднимите приложение:

```bash
npm install
npm run dev
php artisan serve
```

4. Откройте `http://127.0.0.1:8000`.

На первом экране есть четыре секции макета:
- **Header**
- **Summary**
- **Main content**
- **Next step**

Экран показывает, что окружение готово к следующей задаче по auth:
- `.env` найден;
- `APP_KEY` сгенерирован;
- MySQL доступен, миграции/сиды применены;
- status-карточки loaded из базы.

## Почему setup вынесен отдельно

Экран и проверки — это технический health-check рабочего пространства. Реальная auth-логика должна реализовываться отдельно и не зависеть от setup-индикаторов.
