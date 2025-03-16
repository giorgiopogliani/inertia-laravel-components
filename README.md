# Laravel Inertia Components Package

This package provides Livewire inspired components, you can create classes and call them from Vue in a Inertia application.

## Installation

To install the package, you can use Composer:

```bash
composer require performing/laravel-inertia-components
```

## Usage

Once installed, you can start using the provided Inertia components in your Laravel application.

In your Vue components you would something like this:
```vue
<script lang="ts" setup>
import { useComponent } from "@/composables/useComponent";

const { state, loading, action } = useComponent("counter", {
  count: 1,
});
</script>

<template>
  <div>
    <div class="text-blue-700 mb-2">
      {{ loading ? "Loading..." : state.count }}
    </div>
    <Button @click="action('increment')">
      {{ state.count }}
    </Button>
  </div>
</template>
```

And in php you would have a class like this:
```php
class Counter extends Component
{
    public $count = 1;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }
}
```

## Contributing

Contributions are welcome! Please submit a pull request or open an issue to discuss any changes.

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).
