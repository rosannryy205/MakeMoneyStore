<?php

namespace Framework;

class Router
{
    private $routes = [];

    public function add($route, $params = [])
    {
        // Chuyển {param} thành regex để khớp với URL động
        $route = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $route);
        $route = '#^' . $route . '$#'; // Đảm bảo khớp chính xác URL
        $this->routes[$route] = $params;
    }

    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Lấy tất cả tham số động từ URL
                foreach ($matches as $key => $value) {
                    if (!is_int($key)) { // Chỉ lấy các tham số có tên
                        $params[$key] = $value;
                    }
                }
                return $params;
            }
        }
        return false;
    }
}
