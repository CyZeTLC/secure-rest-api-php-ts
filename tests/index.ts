/**
 * Copyright 2026 Tom Coombs
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 */
import { ApiService } from "../src/frontend/ApiService";

export const test = async () => {
    const api = new ApiService('http://localhost:3000');
    api.request('/hello').then(data => {
        console.log('API Response:', data);
    })
    .catch(err => {
        console.error('API Error:', err);
    });
}