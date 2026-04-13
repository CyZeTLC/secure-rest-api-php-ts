# Simple REST API with CSRF Protection (PHP + TypeScript)

## Features

- CSRF Protection with session-based tokens
- Type-safe API client (TypeScript)
- Automatic token refresh
- Clean API routing

## Examples

```ts
const api = new ApiService("http://localhost:8000/api");

const data = await api.request("/hello");
console.log(data.message);
````

````ts
const api = new ApiService("http://localhost:8000/api");

const result = await api.request<{ received: any }>("/data", {
  method: "POST",
  body: JSON.stringify({
    name: "Max M.",
    age: 25
  })
});
console.log(result);
````