# Railway.app Deployment Guide for AzureVoice

## Quick Start (5 Minutes)

### Step 1: Deploy to Railway
1. Visit: **https://railway.app/new**
2. Click "Deploy from GitHub repo"
3. Login with GitHub and authorize Railway
4. Select: **ayoigbala/azurevoice**
5. Click "Deploy Now"

### Step 2: Add MySQL Database
1. In your project dashboard, click "+ New"
2. Select "Database" → "Add MySQL"
3. Wait 30 seconds for provisioning

### Step 3: Configure Environment Variables

Click your web service → "Variables" tab → "RAW Editor" → Paste this:

```env
APP_NAME=AzureVoice
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:OTk5TXdtZFVqSW4yOEd5eXpZOVdSSTBSc1JKV0hEUTU=
APP_URL=https://${{RAILWAY_PUBLIC_DOMAIN}}
APP_ADMIN_PATH=admin
APP_TIMEZONE=UTC

PHP_PROC_OPEN=true

DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}

SESSION_DRIVER=database
SESSION_LIFETIME=43000

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
BROADCAST_DRIVER=log

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls

PAYPAL_APP_CLIENT_ID=
PAYPAL_APP_SECRET=

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_CLIENT_CALLBACK_URL=https://${{RAILWAY_PUBLIC_DOMAIN}}/connect/callback/google

FFMPEG_PATH=/nix/store/*/bin/ffmpeg
FFPROBE_PATH=/nix/store/*/bin/ffprobe
```

### Step 4: Generate Domain
1. Go to "Settings" → "Networking"
2. Click "Generate Domain"
3. You'll get: `azurevoice-production.up.railway.app`

### Step 5: Wait for Deployment
- First deployment: 5-10 minutes
- Watch logs in "Deployments" tab
- Look for: "Server running on [http://0.0.0.0:8080]"

### Step 6: Access Your Site
1. Visit your Railway domain
2. Complete installation wizard if prompted
3. Login to admin: `https://your-domain.railway.app/admin`

---

## Custom Domain Setup

### Connect azurevoice.com:

1. **In Railway:**
   - Settings → Networking → "Custom Domain"
   - Enter: `azurevoice.com`
   - Copy the CNAME target

2. **In Namecheap:**
   - Advanced DNS
   - Add CNAME Record:
     - Host: `@` or `www`
     - Value: `your-app.up.railway.app`
     - TTL: Automatic

3. **Update Environment:**
   - Change `APP_URL` to `https://azurevoice.com`
   - Change `GOOGLE_CLIENT_CALLBACK_URL` to `https://azurevoice.com/connect/callback/google`
   - Redeploy

---

## Auto-Deploy Setup

✅ **Already Configured!**

Every `git push` to `main` branch automatically deploys.

```bash
git add .
git commit -m "Your changes"
git push origin main
```

Railway detects the push and redeploys in 2-3 minutes.

---

## Storage Configuration

### Local Storage (Default)
- Files stored in `/storage/app/public`
- Ephemeral (resets on redeploy)
- Good for testing

### Persistent Storage (Recommended)

**Option 1: Railway Volume**
1. Click "+ New" → "Volume"
2. Mount path: `/app/storage`
3. Redeploy

**Option 2: External Storage**
- Use Cloudinary for images
- Use Bunny CDN for audio files
- Configure in admin panel

---

## Performance Optimization

### 1. Enable OPcache
Add to variables:
```
PHP_OPCACHE_ENABLE=1
```

### 2. Increase Memory
Add to variables:
```
PHP_MEMORY_LIMIT=512M
```

### 3. Queue Workers
For background jobs, add a worker service:
- Duplicate your service
- Change start command to: `php artisan queue:work --tries=3`

---

## Troubleshooting

### Deployment Failed
**Check logs:**
- Click "Deployments" → Latest deployment → "View Logs"

**Common issues:**
1. Missing environment variables
2. Database not connected
3. Composer dependencies failed

**Solution:**
```bash
# In Railway CLI
railway login
railway link
railway run php artisan config:clear
railway run php artisan migrate --force
```

### 500 Error
1. Set `APP_DEBUG=true` temporarily
2. Check logs
3. Run: `php artisan config:clear`
4. Set `APP_DEBUG=false` after fixing

### Database Connection Failed
- Verify MySQL service is running
- Check environment variables match MySQL service
- Restart both services

### FFmpeg Not Found
- FFmpeg is auto-installed via nixpacks.toml
- Path: `/nix/store/*/bin/ffmpeg`
- Check logs for FFmpeg installation

---

## Cost Breakdown

### Free Trial
- $5 credit (no credit card required)
- Lasts ~1 month for small apps

### After Trial
- **Web Service:** ~$5/month
- **MySQL Database:** ~$5/month
- **Total:** ~$10/month

### Usage-Based Pricing
- CPU: $0.000463/minute
- RAM: $0.000231/GB/minute
- Network: Free egress

---

## Railway CLI (Optional)

### Install
```bash
npm i -g @railway/cli
```

### Login
```bash
railway login
```

### Link Project
```bash
railway link
```

### Run Commands
```bash
railway run php artisan migrate
railway run php artisan tinker
railway run php artisan cache:clear
```

### View Logs
```bash
railway logs
```

---

## Monitoring

### Built-in Metrics
- CPU usage
- Memory usage
- Network traffic
- Request count

Access: Project → Service → "Metrics" tab

### External Monitoring
Add to your app:
- Sentry for error tracking
- New Relic for APM
- LogRocket for session replay

---

## Backup Strategy

### Database Backups
1. Install Railway CLI
2. Create backup script:

```bash
#!/bin/bash
railway run mysqldump -u $DB_USERNAME -p$DB_PASSWORD $DB_DATABASE > backup-$(date +%Y%m%d).sql
```

3. Run daily via cron

### File Backups
- Use external storage (recommended)
- Or download `/storage` periodically

---

## Security Checklist

- [ ] Set `APP_DEBUG=false`
- [ ] Use strong `APP_KEY`
- [ ] Enable HTTPS (automatic on Railway)
- [ ] Set secure session cookies
- [ ] Configure CORS properly
- [ ] Use environment variables for secrets
- [ ] Enable rate limiting
- [ ] Keep dependencies updated

---

## Support Resources

- **Railway Docs:** https://docs.railway.app
- **Railway Discord:** https://discord.gg/railway
- **Laravel Docs:** https://laravel.com/docs
- **GitHub Issues:** https://github.com/ayoigbala/azurevoice/issues

---

## Quick Commands Reference

```bash
# Deploy
git push origin main

# View logs
railway logs

# Run migrations
railway run php artisan migrate

# Clear cache
railway run php artisan cache:clear

# Access database
railway connect MySQL

# Restart service
railway restart
```

---

**Your app is now production-ready on Railway! 🚀**
