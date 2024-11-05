<script setup>
import { computed } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
  status: {
    type: String,
  },
});

const form = useForm({});

const submit = () => {
  form.post(route("verification.send"));
};

const verificationLinkSent = computed(() => props.status === "verification-link-sent");
</script>

<template>
  <div>
    <Head title="Email Verification" />
    <section>
      <form @submit.prevent="submit">
        <div class="form">
          <div class="col-2 form-averter">
            <div class="avater">
              <img
                src="../../../../public/asset/photos/3d-male-character-jumping-out-from-smart-phone-screen-and-holding-a-megaphone-free-png.png"
                alt=""
              />
            </div>
          </div>
          <div class="col-2 form-data">
            <div class="form-label">
              <div class="form-header">
                <p>
                  Thanks for signing up! Before getting started, could you verify your
                  email address by clicking on the link we just emailed to you? If you
                  didn't receive the email, we will gladly send you another.
                </p>
              </div>
              <div class="form-body">
                <div
                  class="mb-4 font-medium text-sm text-green-600"
                  v-if="verificationLinkSent"
                >
                  A new verification link has been sent to the email address you provided
                  during registration.
                </div>
                <div class="form-group mb-5">
                  <button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                  >
                    Resend Verification Email
                  </button>
                </div>
                <Link
                  :href="route('logout')"
                  method="post"
                  as="button"
                  class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  >Log Out</Link
                >
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
  </div>
</template>
