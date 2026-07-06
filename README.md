# BarhatTravel — сайт

Кастомная WordPress-тема + must-use плагин для сайта туристической компании ООО «БархатТрэвел».

- **Продакшн:** https://barhattravel.by
- **Хостинг:** ActiveCloud (Беларусь), сервер `by184.atservers.net`
- **Локальная разработка:** Local by Flywheel (`https://barhattravel.local`)

## Структура репозитория

```
├── app/public/wp-content/
│   ├── themes/barhattravel/          ← кастомная тема (Times New Roman, палитра #0026FF)
│   └── mu-plugins/barhattravel-core.php  ← CPT, формы, шорткоды
├── docs/                              ← брифы, дизайн-система, макеты
├── .github/workflows/deploy.yml       ← CI/CD пайплайн деплоя на прод
├── .gitignore
└── README.md
```

**Что НЕ в репозитории** (управляется отдельно):
- WordPress core (ставится на сервере)
- База данных (правится через wp-admin)
- Медиа-библиотека `wp-content/uploads/` (загружается через wp-admin)
- `wp-config.php` (содержит секреты, лежит только на сервере)

## Локальная разработка

1. Установлен **Local by Flywheel**, сайт называется `barhattravel`.
2. Корень проекта: `/Users/admin/Projects/barhattravel/`.
3. Работать с темой: `app/public/wp-content/themes/barhattravel/`.
4. После правки открыть `https://barhattravel.local/` — Local автоматически подхватит изменения.

## CI/CD деплой

При **push в ветку `main`** автоматически запускается GitHub Actions:

1. Проверяется PHP-синтаксис всех файлов темы и mu-plugin (`php -l`)
2. Файлы передаются на прод-сервер по SSH (`by184.atservers.net`)
3. Перезаписываются:
   - `wp-content/themes/barhattravel/`
   - `wp-content/mu-plugins/barhattravel-core.php`
4. WordPress rewrite rules пересобираются через `wp-cli`

**Обычный workflow:**

```bash
# Правите файл темы локально, проверяете в браузере
# Коммитите:
git add app/public/wp-content/themes/barhattravel/
git commit -m "правка X"
git push
# Через ~30-60 секунд изменения появляются на barhattravel.by
```

**Мониторинг деплоя:** https://github.com/USERNAME/REPO/actions

## GitHub Secrets

Пайплайн использует следующие секреты (**Settings → Secrets and variables → Actions**):

| Secret | Значение |
| --- | --- |
| `SSH_HOST` | `by184.atservers.net` |
| `SSH_PORT` | `22` |
| `SSH_USER` | `user2165501` |
| `SSH_KEY` | Приватный ключ (`id_ed25519_barhattravel_deploy`) — весь файл целиком |
| `DEPLOY_PATH` | `/var/www/user2165501/data/www/barhattravel.by` |

Публичный ключ уже установлен в `~/.ssh/authorized_keys` на сервере.

## Что делать НЕ через git

Эти вещи меняются напрямую через wp-admin на проде:

- **Контент страниц** (тексты страниц не в шаблонах)
- **Публикации новостей** (посты)
- **Туры** (CPT `bt_tour`, программы по дням, галереи)
- **Заявки и отзывы**
- **Загрузка изображений** в медиа-библиотеку
- **Меню сайта** (Внешний вид → Меню)

## Экстренный откат

Если после деплоя что-то сломалось:

```bash
git revert HEAD          # откатывает последний коммит
git push                 # триггерит новый деплой с восстановленным состоянием
```

Ручной вариант — на сервере через SSH:

```bash
cd ~/www/barhattravel.by/wp-content/themes/barhattravel
git log --oneline -5     # смотрим последние коммиты
git checkout <sha>       # откат к нужному
```
