import axios from "axios";
import { reactive, ref } from "vue";

export function useComponent<T extends Record<string, any>>(id: string, data: T) {
  const state = reactive({
    ...data
  });

  const loading = ref(false);

  const action = (name: string) => {
    loading.value = true;

    axios.post(id, {
      ...state
    },
    {
      headers: {
        "Content-Type": "application/json",
        "X-Inertia-Action": name,
      },
    })
    .then((response) => {
      for (const key in response.data) {
        state[key] = response.data[key];
      }
    })
    .catch((error) => {
      console.error(error);
    })
    .finally(() => {
      loading.value = false;
    });
  };

  return { state, loading, action };
}
