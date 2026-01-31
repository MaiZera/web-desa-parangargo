# 🚀 Pre-Deployment Checklist

## ✅ Before Upload

- [ ] Run `npm run build` untuk compile production assets
- [ ] Run `composer install --optimize-autoloader --no-dev`
- [ ] Backup database lokal
- [ ] Test semua fitur di local environment
- [ ] Update `.env.example` dengan konfigurasi terbaru

## ✅ Server Setup

- [ ] Upload semua files ke server (exclude: node_modules, .git, .env)
- [ ] Set document root ke folder `public/`
- [ ] Set permissions: `chmod -R 775 storage bootstrap/cache`
- [ ] Create `.env` file di server dengan konfigurasi production
- [ ] Run `composer install --optimize-autoloader --no-dev`
- [ ] Run `npm install && npm run build`
- [ ] Run `php artisan key:generate`
- [ ] Run `php artisan migrate --force`
- [ ] Run `php artisan storage:link`

## ✅ Optimization

- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Enable OPcache di PHP
- [ ] Setup SSL/HTTPS

## ✅ Security

- [ ] `APP_DEBUG=false` di `.env`
- [ ] `APP_ENV=production` di `.env`
- [ ] Strong database password
- [ ] `.env` tidak accessible dari web
- [ ] File permissions correct

## ✅ Testing

- [ ] Homepage loads
- [ ] Admin login works
- [ ] All CRUD operations work
- [ ] Images upload successfully
- [ ] No console errors
- [ ] Mobile responsive

## ✅ Post-Deployment

- [ ] Setup automated backups
- [ ] Configure error monitoring
- [ ] Setup queue workers (if needed)
- [ ] Test email functionality
- [ ] Monitor logs for errors

---

**Lihat `deployment_guide.md` untuk panduan lengkap!**
