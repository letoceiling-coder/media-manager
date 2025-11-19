/**
 * Утилита для работы с API без токенов авторизации
 * Независимый модуль для Media2 компонента
 */

/**
 * Базовый URL API (можно переопределить через props)
 */
let API_BASE = '/api/v1'

/**
 * Установить базовый URL API
 */
export function setApiBase(baseUrl) {
  API_BASE = baseUrl
}

/**
 * Получить базовый URL API
 */
export function getApiBase() {
  return API_BASE
}

/**
 * Выполнить запрос к API без токенов
 */
export async function apiRequest(url, options = {}) {
  const headers = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    ...(options.headers || {})
  }

  // Если передается FormData, убираем Content-Type (браузер установит сам)
  if (options.body instanceof FormData) {
    delete headers['Content-Type']
  }

  const response = await fetch(`${API_BASE}${url}`, {
    ...options,
    headers
  })

  return response
}

/**
 * GET запрос
 */
export async function apiGet(url, options = {}) {
  return apiRequest(url, {
    ...options,
    method: 'GET'
  })
}

/**
 * POST запрос
 */
export async function apiPost(url, data = null, options = {}) {
  const body = data ? (data instanceof FormData ? data : JSON.stringify(data)) : null
  
  return apiRequest(url, {
    ...options,
    method: 'POST',
    body
  })
}

/**
 * PUT запрос
 */
export async function apiPut(url, data = null, options = {}) {
  const body = data ? (data instanceof FormData ? data : JSON.stringify(data)) : null
  
  return apiRequest(url, {
    ...options,
    method: 'PUT',
    body
  })
}

/**
 * DELETE запрос
 */
export async function apiDelete(url, options = {}) {
  return apiRequest(url, {
    ...options,
    method: 'DELETE'
  })
}

/**
 * PATCH запрос
 */
export async function apiPatch(url, data = null, options = {}) {
  const body = data ? (data instanceof FormData ? data : JSON.stringify(data)) : null
  
  return apiRequest(url, {
    ...options,
    method: 'PATCH',
    body
  })
}

