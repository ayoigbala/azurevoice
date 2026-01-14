# Railway.app Deployment Guide for AzureVoice

## Step 1: Sign Up & Connect GitHub

1. Go to https://railway.app
2. Click "Start a New Project"
3. Login with GitHub
4. Authorize Railway to access your repositories

## Step 2: Deploy from GitHub

1. Click "Deploy from GitHub repo"
2. Select: `ayoigbala/azurevoice`
3. Click "Deploy Now"

## Step 3: Add MySQL Database

1. In your project, click "+ New"
2. Select "Database" → "Add MySQL"
3. Wait for database to provision

## Step 4: Configure Environment Variables

Click on your web service → "Variables" tab, add these:

```
APP_NAME=AzureVoice
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:OTk5TXdtZFVqSW4yOEd5eXpZOVdSSTBSc1JKV0hEUTU=
APP_TIMEZONE=UTC

DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQL_HOST}}
DB_PORT=${{MySQL.MYSQL_PORT}}
DB_DATABASE=${{MySQL.MYSQL_DATABASE}}
DB_USERNAME=${{MySQL.MYSQL_USER}}
DB_PASSWORD=${{MySQL.MYSQL_PASSWORD}}

SESSION_DRIVER=database
SESSION_LIFETIME=43000

CACHE_DRIVER=file
QUEUE_CONNECTION=sync

MAIL_DRIVER=smtp
MAIL_HOST=localhost
MAIL_PORT=25

PAYPAL_APP_CLIENT_ID=your_paypal_client_id
PAYPAL_APP_SECRET=your_paypal_secret

GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret

FFMPEG_PATH=/usr/bin/ffmpeg
FFPROBE_PATH=/usr/bin/ffprobe
```

**Note:** Railway auto-fills MySQL variables with `${{MySQL.VARIABLE_NAME}}`

## Step 5: Run Migrations

1. Click on your service → "Settings"
2. Scroll to "Deploy" section
3. Add this to "Custom Start Command":
   ```
   php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
   ```

## Step 6: Set Custom Domain

1. Go to "Settings" → "Networking"
2. Click "Generate Domain" (gets free railway.app subdomain)
3. Or add your custom domain: `azurevoice.com`
   - Add CNAME record in Namecheap pointing to Railway domain

## Step 7: Storage Setup

Since we removed cloud storage, ensure storage is writable:
- Railway provides ephemeral storage
- For persistent storage, consider adding a volume or use external storage

## Auto-Deploy Setup

✅ Already configured! Every push to `main` branch auto-deploys.

## Estimated Cost

- **Free Trial:** $5 credit
- **After trial:** ~$5-10/month depending on usage
- **MySQL:** Included in usage

## Troubleshooting

**If deployment fails:**
1. Check logs in Railway dashboard
2. Ensure all environment variables are set
3. Run: `php artisan config:clear` in Railway CLI

**To access Railway CLI:**
```bash
railway login
railway link
railway run php artisan migrate
```

## Important Notes

- First deployment takes 5-10 minutes
- Railway automatically installs Composer dependencies
- FFmpeg is included via nixpacks.toml
- Storage is ephemeral (resets on redeploy)

## Next Steps After Deployment

1. Visit your Railway URL
2. Complete installation wizard
3. Update `APP_URL` in Railway variables to your actual URL
4. Redeploy after URL update

---

**Support:** https://docs.railway.app
