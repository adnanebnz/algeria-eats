# Nginx Proxy Manager - Global Reverse Proxy

A standalone Nginx Proxy Manager for your VPS to manage **all your applications** with SSL.

## 🚀 VPS Setup

### 1. Copy to VPS

```bash
# From your local machine
scp -r nginx-proxy-manager user@your-vps-ip:/opt/
```

### 2. Start NPM

```bash
ssh user@your-vps-ip
cd /opt/nginx-proxy-manager
docker-compose up -d
```

### 3. Access Admin Panel

| | |
|---|---|
| **URL** | `http://your-vps-ip:81` |
| **Email** | `admin@example.com` |
| **Password** | `changeme` |

⚠️ **Change credentials immediately after first login!**

---

## 🌐 Architecture

```
                    Internet
                        │
                        ▼
    ┌───────────────────────────────────────┐
    │       Nginx Proxy Manager             │
    │       Ports: 80, 443, 81              │
    │       Network: npm-proxy              │
    └───────────────────────────────────────┘
                        │
        ┌───────────────┼───────────────┐
        │               │               │
        ▼               ▼               ▼
   ┌─────────┐    ┌─────────┐    ┌─────────┐
   │ Algeria │    │  App 2  │    │  App 3  │
   │  Eats   │    │         │    │         │
   └─────────┘    └─────────┘    └─────────┘
   
   All apps connect to npm-proxy network
```

---

## 🔧 Adding Applications

### Step 1: Ensure your app is on the proxy network

Your application's `docker-compose.yml` should include:

```yaml
networks:
  npm-proxy:
    external: true
```

### Step 2: Create Proxy Host in NPM

1. Go to **Proxy Hosts** → **Add Proxy Host**
2. Fill in:
   - **Domain Names**: `algeria-eats.yourdomain.com`
   - **Scheme**: `http`
   - **Forward Hostname/IP**: `algeria-eats-nginx` (container name)
   - **Forward Port**: `80`
   - **Block Common Exploits**: ✅
   - **Websockets Support**: ✅ (for Livewire)

### Step 3: Add SSL Certificate

1. In the same proxy host, go to **SSL** tab
2. Select **Request a new SSL Certificate**
3. Check **Force SSL**
4. Check **HTTP/2 Support**
5. Enter your email for Let's Encrypt
6. Click **Save**

## 📋 Common Configurations

### For Laravel/Livewire Apps

**Custom Nginx Configuration** (Advanced tab):
```nginx
location /livewire {
    proxy_pass http://algeria-eats-nginx;
    proxy_http_version 1.1;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection "upgrade";
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-Proto $scheme;
}
```

### WebSocket Support

For real-time features, enable **Websockets Support** in the proxy host settings.

## 🔒 Security Best Practices

1. **Change default credentials** immediately
2. **Use strong passwords** for admin access
3. **Enable 2FA** if available
4. **Restrict port 81** to your IP using firewall:
   ```bash
   # UFW example
   sudo ufw allow from YOUR_IP to any port 81
   ```
5. **Regular backups** of `/opt/nginx-proxy-manager/` volumes

## 🛠️ Maintenance

### View Logs
```bash
docker logs nginx-proxy-manager -f
```

### Update NPM
```bash
cd /opt/nginx-proxy-manager
docker-compose pull
docker-compose up -d
```

### Backup
```bash
# Backup volumes
docker run --rm -v npm-data:/data -v $(pwd):/backup alpine tar cvf /backup/npm-data.tar /data
docker run --rm -v npm-letsencrypt:/data -v $(pwd):/backup alpine tar cvf /backup/npm-letsencrypt.tar /data
```

## 🌐 Network Architecture

```
Internet
    │
    ▼
┌─────────────────────────────┐
│   Nginx Proxy Manager       │
│   Ports: 80, 443, 81        │
└─────────────────────────────┘
    │
    │ npm-proxy network
    │
    ├──► algeria-eats-nginx (port 80)
    │
    ├──► other-app-nginx (port 80)
    │
    └──► another-service (port 3000)
```

## 🆘 Troubleshooting

### Can't connect to application
1. Check container is on `npm-proxy` network:
   ```bash
   docker network inspect npm-proxy
   ```
2. Verify container name matches forward hostname
3. Check application logs

### SSL Certificate Issues
1. Ensure domain DNS points to VPS IP
2. Port 80 must be accessible for ACME challenge
3. Check Let's Encrypt rate limits

### 502 Bad Gateway
1. Application container might not be running
2. Wrong forward port
3. Container not on proxy network
