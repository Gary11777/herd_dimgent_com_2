import type { RouteDefinition } from '@/wayfinder';
import { about, contacts, home, products, projects, services } from '@/routes';

export type NavItem = {
    label: string;
    href: RouteDefinition<'get'>;
};

export type GalleryImage = {
    src: string;
    alt: string;
    caption?: string;
    width: number;
    height: number;
};

export const company = {
    name: 'Dimgent Technologies',
    tagline: 'Electronics Development',
    location: 'Minsk, Belarus',
    email: 'info@dimgent.com',
};

export const navigation: NavItem[] = [
    { label: 'Home', href: home() },
    { label: 'Products', href: products() },
    { label: 'Services', href: services() },
    { label: 'Projects', href: projects() },
    { label: 'About', href: about() },
    { label: 'Contacts', href: contacts() },
];

export const stats = [
    { value: '20+', label: 'Years of experience' },
    { value: '50+', label: 'Completed projects' },
    { value: '100%', label: 'Design success rate' },
    { value: 'Full', label: 'Concept-to-product cycle' },
];

export const offerings = [
    'The full cycle of electronic device development, from concept to finished product.',
    'Individual phases of development, such as circuits, software or PCB layouts.',
    'Completion of unfinished projects that have already been started.',
];

export const highlights = [
    'More than 20 years of experience',
    'More than 50 successfully completed projects',
    'Experienced specialists',
    'Guaranteed quality',
    'Short turn-around times',
    'Cost effective',
];
