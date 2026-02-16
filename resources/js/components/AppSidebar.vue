<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { LayoutGrid, FileText } from 'lucide-vue-next' // ✅ add FileText

import NavMain from '@/components/NavMain.vue'
import NavUser from '@/components/NavUser.vue'
import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarHeader,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
} from '@/components/ui/sidebar'

import { dashboard } from '@/routes'
import alumniInfo from '@/routes/alumni-info' // ✅ FIXED PATH (matches routes/alumni-info/index.ts)

import type { NavItem } from '@/types'
import AppLogo from './AppLogo.vue'

const mainNavItems: NavItem[] = [
  {
    title: 'Dashboard',
    href: dashboard.url(), // ✅ FIX (dashboard() -> dashboard.url())
    icon: LayoutGrid,
  },
  {
    title: 'Alumni Form',
    href: alumniInfo.create.url(),
    icon: FileText,
  },
]
</script>

<template>
  <Sidebar collapsible="icon" variant="inset">
    <SidebarHeader>
      <SidebarMenu>
        <SidebarMenuItem>
          <SidebarMenuButton size="lg" as-child>
            <Link :href="dashboard.url()"> <!-- ✅ FIX -->
              <AppLogo />
            </Link>
          </SidebarMenuButton>
        </SidebarMenuItem>
      </SidebarMenu>
    </SidebarHeader>

    <SidebarContent>
      <NavMain :items="mainNavItems" />
    </SidebarContent>

    <SidebarFooter>
      <NavUser />
    </SidebarFooter>
  </Sidebar>

  <slot />
</template>
