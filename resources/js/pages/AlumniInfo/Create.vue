<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { toast } from 'vue-sonner'

import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { Button } from '@/components/ui/button'
import { Checkbox } from '@/components/ui/checkbox'

import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'

import alumniInfo from '@/routes/alumni-info'

const form = useForm({
  // PERSONAL INFORMATION
  student_number: '',
  first_name: '',
  middle_initial: '',
  last_name: '',
  contact_number: '',
  email: '',
  address: '',

  // ACADEMIC INFORMATION
  program_taken: '',
  year_batch_graduated: '',

  // EMPLOYMENT INFORMATION
  employment_status: '',
  sector_of_employment: '',
  company_name: '',
  work_location: '',

  // FEEDBACK
  overall_rating: 3,

  // CONSENT
  data_privacy_consent: false,
})

const submit = () => {
  // ✅ FRONTEND GUARD: do not submit if not checked
  if (!form.data_privacy_consent) {
    form.setError('data_privacy_consent', 'You must agree to the data privacy consent to proceed.')
    return
  }

  form.clearErrors('data_privacy_consent')

  form
    .transform((data) => ({
      ...data,
      // ✅ send accepted-friendly values
      data_privacy_consent: data.data_privacy_consent ? 1 : 0,
      overall_rating: Number(data.overall_rating),
      year_batch_graduated: data.year_batch_graduated,
    }))
    .post(alumniInfo.store.url(), {
      preserveScroll: true,
      onError: (errors) => {
        const firstError = Object.values(errors)[0]
        toast.error(firstError || 'Submission failed. Please check the form fields.')
      },
    })
}

// ✅ stable setter (forces boolean only)
const setConsent = (v: boolean | 'indeterminate') => {
  form.data_privacy_consent = v === true
  if (form.data_privacy_consent) form.clearErrors('data_privacy_consent')
}

// ✅ click-to-toggle for the whole consent area
const toggleConsent = () => {
  form.data_privacy_consent = !form.data_privacy_consent
  if (form.data_privacy_consent) form.clearErrors('data_privacy_consent')
}
</script>

<template>
  <Head title="Alumni Information Form" />

  <AppLayout>
    <div class="mx-auto w-full max-w-4xl p-4 md:p-8 space-y-6">
      <!-- Page header -->
      <div class="space-y-1">
        <h1 class="text-2xl font-semibold tracking-tight">Alumni Information Form</h1>
        <p class="text-sm text-muted-foreground">
          Please complete the required fields (<span class="text-red-600">*</span>) and submit your information.
        </p>
      </div>

      <form class="space-y-6" @submit.prevent="submit">
        <!-- PERSONAL INFORMATION -->
        <Card>
          <CardHeader class="pb-3">
            <CardTitle class="text-lg">Personal Information</CardTitle>
            <CardDescription>Basic information about you.</CardDescription>
          </CardHeader>

          <CardContent class="space-y-5">
            <div class="grid gap-4 md:grid-cols-3">
              <div class="space-y-2 md:col-span-1">
                <Label for="student_number">
                  Student Number <span class="text-red-600">*</span>
                </Label>
                <Input id="student_number" v-model="form.student_number" placeholder="e.g. 2020-12345" />
                <p v-if="form.errors.student_number" class="text-sm text-red-600">
                  {{ form.errors.student_number }}
                </p>
              </div>

              <div class="space-y-2 md:col-span-1">
                <Label for="contact_number">
                  Contact Number <span class="text-red-600">*</span>
                </Label>
                <Input id="contact_number" v-model="form.contact_number" placeholder="e.g. 09xxxxxxxxx" />
                <p v-if="form.errors.contact_number" class="text-sm text-red-600">
                  {{ form.errors.contact_number }}
                </p>
              </div>

              <div class="space-y-2 md:col-span-1">
                <Label for="email">
                  Active Email Address <span class="text-red-600">*</span>
                </Label>
                <Input id="email" type="email" v-model="form.email" placeholder="name@email.com" />
                <p v-if="form.errors.email" class="text-sm text-red-600">
                  {{ form.errors.email }}
                </p>
              </div>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
              <div class="space-y-2">
                <Label for="first_name">
                  First Name <span class="text-red-600">*</span>
                </Label>
                <Input id="first_name" v-model="form.first_name" placeholder="First name" />
                <p v-if="form.errors.first_name" class="text-sm text-red-600">
                  {{ form.errors.first_name }}
                </p>
              </div>

              <div class="space-y-2">
                <Label for="middle_initial">Middle Initial</Label>
                <Input id="middle_initial" v-model="form.middle_initial" placeholder="e.g. A" />
                <p v-if="form.errors.middle_initial" class="text-sm text-red-600">
                  {{ form.errors.middle_initial }}
                </p>
              </div>

              <div class="space-y-2">
                <Label for="last_name">
                  Last Name <span class="text-red-600">*</span>
                </Label>
                <Input id="last_name" v-model="form.last_name" placeholder="Last name" />
                <p v-if="form.errors.last_name" class="text-sm text-red-600">
                  {{ form.errors.last_name }}
                </p>
              </div>
            </div>

            <div class="space-y-2">
              <Label for="address">
                Address <span class="text-red-600">*</span>
              </Label>
              <Textarea
                id="address"
                v-model="form.address"
                placeholder="Complete address..."
                class="min-h-[110px]"
              />
              <p v-if="form.errors.address" class="text-sm text-red-600">
                {{ form.errors.address }}
              </p>
            </div>
          </CardContent>
        </Card>

        <!-- ACADEMIC INFORMATION -->
        <Card>
          <CardHeader class="pb-3">
            <CardTitle class="text-lg">Academic Information</CardTitle>
            <CardDescription>Your program and graduation details.</CardDescription>
          </CardHeader>

          <CardContent class="grid gap-4 md:grid-cols-2">
            <div class="space-y-2">
              <Label for="program_taken">
                Program Taken <span class="text-red-600">*</span>
              </Label>
              <Input id="program_taken" v-model="form.program_taken" placeholder="e.g. BSIT" />
              <p v-if="form.errors.program_taken" class="text-sm text-red-600">
                {{ form.errors.program_taken }}
              </p>
            </div>

            <div class="space-y-2">
              <Label for="year_batch_graduated">
                Year / Batch Graduated <span class="text-red-600">*</span>
              </Label>
              <Input
                id="year_batch_graduated"
                v-model="form.year_batch_graduated"
                placeholder="e.g. 2024"
              />
              <p v-if="form.errors.year_batch_graduated" class="text-sm text-red-600">
                {{ form.errors.year_batch_graduated }}
              </p>
            </div>
          </CardContent>
        </Card>

        <!-- EMPLOYMENT INFORMATION -->
        <Card>
          <CardHeader class="pb-3">
            <CardTitle class="text-lg">Employment Information</CardTitle>
            <CardDescription>Your employment details (if applicable).</CardDescription>
          </CardHeader>

          <CardContent class="grid gap-4 md:grid-cols-2">
            <div class="space-y-2">
              <Label>
                Employment Status <span class="text-red-600">*</span>
              </Label>
              <Select v-model="form.employment_status">
                <SelectTrigger>
                  <SelectValue placeholder="Select status" />
                </SelectTrigger>
                <SelectContent>
                  <SelectGroup>
                    <SelectLabel>Status</SelectLabel>
                    <SelectItem value="Employed">Employed</SelectItem>
                    <SelectItem value="Unemployed">Unemployed</SelectItem>
                    <SelectItem value="Self-Employed">Self-Employed</SelectItem>
                    <SelectItem value="Student">Student</SelectItem>
                    <SelectItem value="Other">Other</SelectItem>
                  </SelectGroup>
                </SelectContent>
              </Select>
              <p v-if="form.errors.employment_status" class="text-sm text-red-600">
                {{ form.errors.employment_status }}
              </p>
            </div>

            <div class="space-y-2">
              <Label for="sector_of_employment">Sector of Employment</Label>
              <Input
                id="sector_of_employment"
                v-model="form.sector_of_employment"
                placeholder="e.g. IT, Education"
              />
              <p v-if="form.errors.sector_of_employment" class="text-sm text-red-600">
                {{ form.errors.sector_of_employment }}
              </p>
            </div>

            <div class="space-y-2">
              <Label for="company_name">Company / Workplace Name</Label>
              <Input id="company_name" v-model="form.company_name" placeholder="Company name" />
              <p v-if="form.errors.company_name" class="text-sm text-red-600">
                {{ form.errors.company_name }}
              </p>
            </div>

            <div class="space-y-2">
              <Label for="work_location">Work Location</Label>
              <Input id="work_location" v-model="form.work_location" placeholder="e.g. Remote / City" />
              <p v-if="form.errors.work_location" class="text-sm text-red-600">
                {{ form.errors.work_location }}
              </p>
            </div>
          </CardContent>
        </Card>

        <!-- FEEDBACK -->
        <Card>
          <CardHeader class="pb-3">
            <CardTitle class="text-lg">Feedback</CardTitle>
            <CardDescription>Rate your overall experience.</CardDescription>
          </CardHeader>

          <CardContent class="max-w-sm space-y-2">
            <Label>
              Overall Rating (1–5) <span class="text-red-600">*</span>
            </Label>
            <Select v-model="form.overall_rating">
              <SelectTrigger>
                <SelectValue placeholder="Select rating" />
              </SelectTrigger>
              <SelectContent>
                <SelectGroup>
                  <SelectLabel>Rating</SelectLabel>
                  <SelectItem :value="1">1</SelectItem>
                  <SelectItem :value="2">2</SelectItem>
                  <SelectItem :value="3">3</SelectItem>
                  <SelectItem :value="4">4</SelectItem>
                  <SelectItem :value="5">5</SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select>

            <p v-if="form.errors.overall_rating" class="text-sm text-red-600">
              {{ form.errors.overall_rating }}
            </p>
          </CardContent>
        </Card>

        <!-- CONSENT -->
        <Card>
          <CardHeader class="pb-3">
            <CardTitle class="text-lg">Consent</CardTitle>
            <CardDescription>Data privacy and consent agreement.</CardDescription>
          </CardHeader>

          <CardContent class="space-y-3">
            <!-- ✅ whole box clickable -->
            <div
              class="flex items-start gap-3 rounded-lg border p-4 cursor-pointer select-none"
              @click="toggleConsent"
            >
              <!-- ✅ only boolean state -->
              <Checkbox
                :checked="form.data_privacy_consent"
                @update:checked="setConsent"
                @click.stop
              />

              <div class="space-y-1">
                <p class="text-sm font-medium leading-5">
                  Data Privacy Consent <span class="text-red-600">*</span>
                </p>
                <p class="text-sm text-muted-foreground leading-5">
                  I agree to the collection and processing of my personal data for alumni tracking purposes.
                </p>
              </div>
            </div>

            <p v-if="form.errors.data_privacy_consent" class="text-sm text-red-600">
              {{ form.errors.data_privacy_consent }}
            </p>
          </CardContent>
        </Card>

        <!-- ACTIONS -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-end">
          <Button type="button" variant="outline" :disabled="form.processing" @click="form.reset()">
            Reset
          </Button>

          <Button type="submit" :disabled="form.processing || !form.data_privacy_consent">
            {{ form.processing ? 'Submitting...' : 'Submit' }}
          </Button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>
