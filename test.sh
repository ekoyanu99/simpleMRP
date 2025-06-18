#!/bin/bash

npm run production

echo "=== TESTING WEB ROUTES ==="

ROUTES=("/" "/login")

for route in "${ROUTES[@]}"; do
  STATUS=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8000$route)
  if [ "$STATUS" -eq 200 ]; then
    echo "✅ $route (HTTP $STATUS)"
  else
    echo "❌ $route (HTTP $STATUS)"
    curl -v http://localhost:8000$route
  fi
done

vercel dev --yes --listen 3000 &
VERCEL_PID=$!
sleep 5

echo "=== TESTING DI VERCEL LOCAL ==="
curl -s http://localhost:3000 | grep -q "Laravel" && echo "✅ Homepage OK" || echo "❌ Homepage gagal"

kill $VERCEL_PID