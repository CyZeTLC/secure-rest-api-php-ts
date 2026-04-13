export class ApiService {
  private csrfToken: string | null = null;

  constructor(private baseUrl: string) { }

  async getCsrfToken(): Promise<void> {
    const res = await fetch(`${this.baseUrl}/csrf`, {
      credentials: 'include'
    });

    const data = await res.json();
    this.csrfToken = data.csrf;
  }

  async request<T>(endpoint: string, options: RequestInit = {}): Promise<T> {
    if (!this.csrfToken) {
      await this.getCsrfToken();
    }

    const controller = new AbortController();
    const timeout = setTimeout(() => controller.abort(), 5000);

    try {
      const res = await fetch(`${this.baseUrl}${endpoint}`, {
        ...options,
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-Token': this.csrfToken!,
          ...(options.headers || {})
        },
        signal: controller.signal
      });

      if (res.status === 403) {
        await this.getCsrfToken();
        return this.request(endpoint, options);
      }

      const data = await res.json();

      if (!res.ok) {
        throw new Error(data.message || 'API Error');
      }

      return data as T;
    } finally {
      clearTimeout(timeout);
    }
  }
}