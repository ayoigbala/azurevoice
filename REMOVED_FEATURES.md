# Removed Features Documentation

## Date: $(date)
## Removed by: ayoigbala

This document lists all features that have been completely removed from the AzureVoice application.

---

## Storage Providers Removed

1. **AWS S3** - Removed all S3 storage configurations
2. **Cloudflare R2** - Removed R2 storage configurations  
3. **Wasabi Storage** - Removed Wasabi storage configurations

**Impact:** Application now uses only local storage (public disk)

---

## Payment Gateways Removed

1. **Stripe** - Removed Stripe payment integration
2. **FlutterWave** - Removed FlutterWave payment gateway
3. **PayStack** - Removed PayStack payment gateway
4. **PayHere** - Removed PayHere payment gateway
5. **Bank Wire** - Removed bank wire transfer option
6. **DPO** - Removed DPO payment module
7. **AIM** - Removed AIM payment module

**Remaining:** PayPal only

---

## Social Authentication Removed

1. **Facebook Login** - Removed Facebook OAuth
2. **Twitter Login** - Removed Twitter OAuth
3. **Apple Sign In** - Removed Apple authentication
4. **Discord Login** - Removed Discord OAuth

**Remaining:** Google Login only

---

## External APIs Removed

1. **Spotify API** - Removed Spotify integration
2. **Envato API** - License verification bypassed (already done)

---

## Files Deleted

- `/app/Modules/FlutterWave/`
- `/app/Modules/PayStack/`
- `/app/Modules/PayHere/`
- `/app/Modules/BankWire/`
- `/app/Modules/DPO/`
- `/app/Modules/AIM/`
- `/app/Http/Controllers/Frontend/StripeController.php`

---

## Configuration Files Modified

1. **/.env.example** - Removed all API keys for removed services
2. **/config/services.php** - Removed OAuth configs for Facebook, Twitter, Apple, Discord
3. **/config/payment.php** - Removed all payment gateways except PayPal
4. **/config/filesystems.php** - Removed S3, Wasabi, R2 disk configurations
5. **/composer.json** - Removed AWS SDK, Stripe PHP, and Flysystem S3 packages

---

## Next Steps

After pulling these changes to your server:

1. Run: `composer update` to remove unused packages
2. Clear cache: `php artisan config:clear`
3. Clear cache: `php artisan cache:clear`
4. Update settings in admin panel to use local storage only

---

## Remaining Active Features

- **Storage:** Local/Public disk only
- **Payment:** PayPal only
- **Social Login:** Google only
- **APIs:** OpenAI (active)
