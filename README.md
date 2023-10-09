# pinahangi-app

[![Build](https://github.com/bolsel/pinahangi-app/actions/workflows/staging.yml/badge.svg)](https://github.com/bolsel/pinahangi-app/actions/workflows/staging.yml) [![Release](https://github.com/bolsel/pinahangi-app/actions/workflows/release.yml/badge.svg)](https://github.com/bolsel/pinahangi-app/actions/workflows/release.yml)

## Setup

### 1. Clone this repo

```bash
git clone https://github.com/bolsel/pinahangi-app && cd pinahangi-app
```

### 2. Install dependencies

```bash
composer install
```

### 3. copy `.env.example` > `.env`

### 4. Create sail alias command

```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

### 5. Run

```bash
sail up -d
```
