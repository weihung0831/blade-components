---
paths:
  - 'resources/views/components/**'
---

# Components

## Anonymous component 內不要用 $slot 當迴圈變數
在 anonymous component（resources/views/components/ 底下）裡寫 `@foreach (range(0, 29) as $slot)` 會蓋掉 Blade 傳進來的 `$slot`，`{{ $slot }}` 直接印出迴圈最後的值（例如 29），插槽內容整段消失，而且不會噴任何錯誤。

改用別的變數名，例如 `$tick`。auth 模板的 shell（uptime 條）踩過一次。

只在 component 檔案裡有問題；一般 page view 用 `$slot` 當變數名不受影響。
