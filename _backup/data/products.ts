
import { Product, Category } from '../types';

export const products: Product[] = [
  {
    id: 'sunmi-v2-pro',
    name: 'Sunmi V2 PRO Portable',
    category: Category.PRINTER,
    price: 2999000,
    originalPrice: 3500000,
    description: 'Terminal POS genggam dengan printer thermal terintegrasi 58mm. Sangat cocok untuk mobilitas tinggi, cafe, dan food truck.',
    image: 'https://images.unsplash.com/photo-1556742044-3c52d6e88c62?q=80&w=800&auto=format&fit=crop',
    tags: ['MokaPOS', 'Android', 'Portable'],
    isReadyStock: true,
    specs: {
      'Printing Speed': '70mm/s',
      'Operating System': 'Android 7.1',
      'Display': '5.99" HD+',
      'Battery': '2580mAh',
      'Connectivity': '4G / Wi-Fi / Bluetooth'
    }
  },
  {
    id: 'epson-tm-t82-iii',
    name: 'Epson TM-T82 III Thermal',
    category: Category.PRINTER,
    price: 2150000,
    description: 'Printer kasir legendaris dengan daya tahan tinggi dan auto-cutter. Standar industri retail dan resto.',
    image: 'https://images.unsplash.com/photo-1612815154858-60aa4c59eaa6?q=80&w=800&auto=format&fit=crop',
    tags: ['Windows', 'USB+Serial', 'Heavy Duty'],
    isBestSeller: true,
    specs: {
      'Printing Speed': '250mm/s',
      'Paper Width': '80mm',
      'Interface': 'USB + Serial / LAN',
      'Reliability': '60 million lines',
      'Cutter': 'Auto-cutter'
    }
  },
  {
    id: 'jaya-maju-aio',
    name: 'JAYA MAJU All-in-One POS V1',
    category: Category.KOMPUTER,
    price: 6750000,
    description: 'Paket lengkap komputer kasir layar sentuh 15 inch premium. Desain modern, hemat ruang, dan performa stabil.',
    image: 'https://images.unsplash.com/photo-1591488320449-011701bb6704?q=80&w=800&auto=format&fit=crop',
    tags: ['Windows 10', 'Touchscreen', 'Premium'],
    specs: {
      'Processor': 'Intel Celeron J4125',
      'Memory': '4GB DDR4',
      'Storage': '128GB SSD',
      'Display': '15" Capacitive Touch',
      'Ports': '6x USB, 1x LAN, 1x VGA'
    }
  },
  {
    id: 'honeywell-hh490',
    name: 'Honeywell HH490 2D Scanner',
    category: Category.SCANNER,
    price: 1450000,
    description: 'Scanner barcode 2D (QR Code) berperforma tinggi untuk retail modern. Cepat baca barcode rusak atau di layar HP.',
    image: 'https://images.unsplash.com/photo-1606103920295-9a091573f160?q=80&w=800&auto=format&fit=crop',
    tags: ['2D/QR', 'USB', 'Industrial'],
    isReadyStock: true,
    specs: {
      'Scan Type': 'Area Image (2D)',
      'Interface': 'USB',
      'Scan Speed': '60 fps',
      'Durability': 'IP40 Rating',
      'Warranty': '1 Year'
    }
  },
  {
    id: 'star-mcp31',
    name: 'Star Micronics MCP31 Cloud',
    category: Category.PRINTER,
    price: 4450000,
    description: 'Cloud-Ready Receipt Printer dengan desain elegan dan konektivitas lengkap untuk iPad/iPhone POS.',
    image: 'https://images.unsplash.com/photo-1589118949245-7d38baf380d6?q=80&w=800&auto=format&fit=crop',
    tags: ['Enterprise', 'CloudPRNT', 'iOS Ready'],
    specs: {
      'Printing Speed': '250mm/s',
      'Interface': 'USB, LAN, Bluetooth',
      'Cloud Support': 'Yes (CloudPRNT)',
      'OS Support': 'iOS, Android, Windows',
      'Special': 'USB Charge for iPad'
    }
  },
  {
    id: 'paket-umkm-lite',
    name: 'Paket UMKM Lite (Android)',
    category: Category.PAKET,
    price: 4200000,
    originalPrice: 4800000,
    description: 'Paket lengkap untuk pemula. Tablet 10", Stand Holder, dan Printer Bluetooth 58mm.',
    image: 'https://images.unsplash.com/photo-1556740758-90de374c12ad?q=80&w=800&auto=format&fit=crop',
    tags: ['Bundle', 'UMKM', 'Android'],
    isBestSeller: true,
    specs: {
      'Hardware': 'Tablet 10" + BT Printer',
      'Software': 'Free POS Basic 1yr',
      'Installation': 'Free Remote Setup',
      'Training': 'Video Tutorial Incl.',
      'Support': 'Priority WA'
    }
  }
];
