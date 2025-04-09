'use client';

import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
} from '@/components/ui/alert-dialog';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import AppLayout from '@/layouts/app-layout';
import { router, useForm, usePage } from '@inertiajs/react';
import { Pencil, Plus, Search, Trash2 } from 'lucide-react';
import { use, useEffect, useState } from 'react';
import Carousel from '../../components/Carousel';
import { useAppearance } from '@/hooks/use-appearance';


const breadcrumbs = [
    {
        title: 'Equipment',
        href: '/equipment',
    },
];

export default function Equipment() {
    const [searchQuery, setSearchQuery] = useState("");
    const [filterType, setFilterType] = useState('all');
    const [isAddModalOpen, setIsAddModalOpen] = useState(false);
    const [isEditModalOpen, setIsEditModalOpen] = useState(false);
    const [isDeleteModalOpen, setIsDeleteModalOpen] = useState(false);
    const [currentEquipment, setCurrentEquipment] = useState(null);
    const { appearance } = useAppearance();


    const [formData, setFormData] = useState({
        reference: '',
        mark: '',
        state: '',
        equipment_type: '',
        image: '',
    });


    const [imagePreview, setImagePreview] = useState(null)

    const handleImageUpload = (e) => {
        const file = e.target.files[0]
        if (file) {
            setData({ ...data, image: file })
            setImagePreview(URL.createObjectURL(file))
        }
    }




    const {
        data,
        setData,
        post,
        processing,
        errors,
        reset,
        delete: destroy,
        put
    } = useForm({
        reference: '',
        mark: '',
        equipment_type: '',
        state: '',
        image: null,
    });

    const resetForm = () => {
        setData({
            reference: '',
            mark: '',
            state: '',
            equipment_type: '',
            image: null,
        });
    };

    const { equipments } = usePage().props;

    const resetFilters = () => {
        setSearchQuery('');
        setFilterType('all');
    };




    const filteredEquipments = equipments.data.filter((equipment) => {
        const reference = equipment.reference.toLowerCase();
        const mark = equipment.mark.toLowerCase();
        const search = searchQuery.toLowerCase();
        const matchesSearch = reference.includes(search) || mark.includes(search);
        const matchesType = filterType === "all" || equipment.equipment_type === filterType;
        return matchesSearch && matchesType;
    });



    const AddEquipment = (e) => {
        e.preventDefault();
        post(route('equipment.store'), {
            onFinish: () => reset(),
        });
        resetForm();
        setIsAddModalOpen(false);
    };

    const openDeleteModal = (equipment) => {
        setCurrentEquipment(equipment);
        setIsDeleteModalOpen(true);
    };

    const handleDeleteEquipment = () => {
        if (currentEquipment) {
            destroy(route('equipment.destroy', currentEquipment.id));
            setIsDeleteModalOpen(false);
            setCurrentEquipment(null);
        }
    };

    const openEditModal = (equipment) => {
        setCurrentEquipment(equipment);
        setData({
            reference: equipment.reference,
            mark: equipment.mark,
            state: equipment.state,
            equipment_type: equipment.equipment_type,
            image: null,
        });
        setIsEditModalOpen(true);
    };

    const handleEditEquipment = (e) => {
        e.preventDefault();
        console.log(data)
        if (currentEquipment) {
            post(route('equipment.update', currentEquipment), {
                _method: 'put',
                data: data,
            })
            setIsEditModalOpen(false);
            setCurrentEquipment(null);
            resetForm();
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <div className="container mx-auto p-6">
                <h1 className="mb-8 text-4xl font-bold">Equipment</h1>

                {/* Top Bar */}
                <div className="mb-8 flex flex-col items-start justify-between gap-4 md:flex-row md:items-center">
                    <div className="flex w-full flex-col gap-4 md:w-auto md:flex-row">
                        <div className="relative flex gap-5 w-full md:w-64">
                            <Search className="absolute top-1/2 left-3 -translate-y-1/2 transform text-gray-400" size={18} />
                            <Input
                                type="text"
                                placeholder="search"
                                value={searchQuery}
                                onChange={(e) => setSearchQuery(e.target.value)}
                                className={`w-96 border-gray-300 ${appearance === "dark" ? "bg-[#171717] text-white" : ""}  pl-10 text-white`}
                            />
                        </div>

                        <Select value={filterType} onValueChange={(value) => setFilterType(value)}>
                            <SelectTrigger className={`w-80 border-gray-300 ${appearance === "dark" ? "bg-[#171717] text-white" : ""} md:w-40`}>
                                <SelectValue placeholder="Filter by type" />
                            </SelectTrigger>
                            <SelectContent className={`border-gray-300 ${appearance === "dark" ? "bg-[#171717] text-white" : ""} `}>
                                <SelectItem value="all">all</SelectItem>
                                <SelectItem value="camera">camera</SelectItem>
                                <SelectItem value="son">son</SelectItem>
                                <SelectItem value="lumiere">lumiere</SelectItem>
                                <SelectItem value="data/stockage">data/stockage</SelectItem>
                                <SelectItem value="podcast">podcast</SelectItem>
                                <SelectItem value="other">other</SelectItem>
                            </SelectContent>
                        </Select>

                        <Button variant="default" className="bg-alpha text-black hover:bg-yellow-600" onClick={resetFilters}>
                            Reset Filter
                        </Button>
                    </div>

                    <Button
                        variant="default"
                        className="w-full bg-alpha text-black hover:bg-yellow-600 md:w-auto"
                        onClick={() => setIsAddModalOpen(true)}
                    >
                        <Plus size={18} className="mr-2" /> Add Equipment
                    </Button>
                </div>

                {/* Equipment Cards */}
                <div className="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    {filteredEquipments?.map((equipment) => (
                        <div key={equipment.id} className={`relative overflow-hidden rounded-lg  ${appearance === "dark" ? "bg-[#171717] text-white" : "bg-[#fafafa] shadow-lg shadow-gray-400"} `}>
                            <div className="relative h-48 w-full">
                                {equipment.images && equipment.images.length > 1 ? (
                                    <Carousel name="equipment" images={equipment.images} />
                                ) : equipment.images && equipment.images.length === 1 ? (
                                    <img className="rounded-t-md h-[100%] w-[100%]" src={`/storage/images/equipment/${equipment.images[0].path}`} alt="" />
                                ) : (
                                    <div className="flex h-48 items-center justify-center bg-gray-700 text-white">No Image Available</div>
                                )}

                                <div className="absolute top-2 right-2 flex gap-2 z-20">
                                    <button
                                        onClick={() => openDeleteModal(equipment)}
                                        className={`rounded-md ${appearance === "dark" ? "bg-[#171717]" : "bg-white"} p-2`}
                                    >
                                        <Trash2 size={16} />
                                    </button>
                                    <button
                                        onClick={() => openEditModal(equipment)}
                                        className={`rounded-md ${appearance === "dark" ? "bg-[#171717]" : "bg-white"}  p-2 `}
                                    >
                                        <Pencil size={16} />
                                    </button>
                                </div>
                            </div>
                            <div className="p-4">
                                <p>
                                    <span className="text-yellow-500">Reference : </span>
                                    <span className="">{equipment.reference}</span>
                                </p>
                                <p>
                                    <span className="text-yellow-500">Mark : </span>
                                    <span className="">{equipment.mark}</span>
                                </p>
                                <p>
                                    <span className="text-yellow-500">Equipment Type : </span>
                                    <span className="">{equipment.equipment_type}</span>
                                </p>
                                <p>
                                    <span className="text-yellow-500">State : </span>
                                    <span className="">{equipment.state === 'Work' ? 'Work' : 'Not Work'}</span>
                                </p>
                            </div>
                        </div>
                    ))}
                </div>

                {/* Add Equipment Modal */}
                <Dialog open={isAddModalOpen} onOpenChange={setIsAddModalOpen}>
                    <DialogContent className={`border-gray-700 ${appearance === "dark" ? " bg-[#171717] text-white" : ""} `}>
                        <DialogHeader>
                            <DialogTitle className="text-xl font-bold">Add New Equipment</DialogTitle>
                        </DialogHeader>
                        <form encType="multipart/form-data" onSubmit={AddEquipment}>
                            <div className="grid gap-4 py-4">
                                <div className="grid gap-2">
                                    <Label htmlFor="reference">Reference</Label>
                                    <Input
                                        id="reference"
                                        name="reference"
                                        value={data.reference}
                                        onChange={(e) => setData('reference', e.target.value)}
                                        className={`${appearance === "dark" ? "bg-[#262626] text-white" : ""} `}
                                    />
                                </div>
                                <div className="grid gap-2">
                                    <Label htmlFor="mark">Mark</Label>
                                    <Input
                                        id="mark"
                                        name="mark"
                                        value={data.mark}
                                        onChange={(e) => setData('mark', e.target.value)}
                                        className={`${appearance === "dark" ? "bg-[#262626] text-white" : ""} `}
                                    />
                                </div>
                                <div className="grid gap-2">
                                    <Label>State</Label>
                                    <div className="flex gap-4">
                                        <div className="flex items-center space-x-2">
                                            <input
                                                type="radio"
                                                id="work"
                                                name="state"
                                                value="Work"
                                                checked={data.state === 'Work'}
                                                onChange={(e) => setData('state', e.target.value)}
                                            />
                                            <label htmlFor="work">Work</label>
                                        </div>
                                        <div className="flex items-center space-x-2">
                                            <input
                                                type="radio"
                                                id="not-work"
                                                name="state"
                                                value="Not Work"
                                                checked={data.state === 'Not Work'}
                                                onChange={(e) => setData('state', e.target.value)}
                                            />
                                            <label htmlFor="not-work">Not Work</label>
                                        </div>
                                    </div>

                                    <div className="grid gap-2">
                                        <label htmlFor="type">Equipment Type</label>
                                        <select
                                            id="type"
                                            value={data.equipment_type}
                                            onChange={(e) => setData('equipment_type', e.target.value)}
                                            className={`p-2 rounded-md  ${appearance === "dark" ? "bg-[#262626] text-white" : "border-2 border-gray-100"} `}
                                        >
                                            <option disabled selected value="">Select type</option>
                                            <option value="camera">Camera</option>
                                            <option value="son">Son</option>
                                            <option value="lumiere">Lumiere</option>
                                            <option value="data/stockage">Data/Stockage</option>
                                            <option value="podcast">Podcast</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div className="grid gap-2">
                                    <Label htmlFor="image">Image</Label>
                                    <Input
                                        id="image"
                                        type="file"
                                        accept="image/*"
                                        multiple
                                        onChange={(e) => setData('image', e.target.files)}
                                        className={`${appearance === "dark" ? "bg-[#262626] text-white" : ""} `}
                                    />
                                </div>
                            </div>

                            <DialogFooter>
                                <Button
                                    variant="outline"
                                    onClick={() => {
                                        setIsAddModalOpen(false);
                                    }}
                                    className={`border-gray-700  ${appearance === "dark" ? " text-white" : ""} `}
                                >
                                    Cancel
                                </Button>
                                <Button disabled={processing} className="bg-yellow-500 text-black hover:bg-yellow-600">
                                    {processing ? 'Adding...' : 'Add'}
                                </Button>
                            </DialogFooter>
                        </form>
                    </DialogContent>
                </Dialog>

                {/* Edit Equipment Modal */}
                <Dialog open={isEditModalOpen} onOpenChange={setIsEditModalOpen}>
                    <DialogContent className={`border-gray-700 ${appearance === "dark" ? " bg-[#171717] text-white" : ""} `}>
                        <DialogHeader>
                            <DialogTitle className="text-xl font-bold">Edit Equipment</DialogTitle>
                        </DialogHeader>
                        <form encType="multipart/form-data" onSubmit={handleEditEquipment}>
                            <div className="grid gap-4 py-4">
                                <div className="grid gap-2">
                                    <Label htmlFor="edit-reference">Reference</Label>
                                    <Input
                                        id="edit-reference"
                                        name="reference"
                                        value={data.reference}
                                        onChange={(e) => setData('reference', e.target.value)}
                                        className={`${appearance === "dark" ? "bg-[#262626] text-white" : ""} `}
                                    />
                                </div>
                                <div className="grid gap-2">
                                    <Label htmlFor="edit-mark">Mark</Label>
                                    <Input
                                        id="edit-mark"
                                        name="mark"
                                        value={data.mark}
                                        onChange={(e) => setData('mark', e.target.value)}
                                        className={`${appearance === "dark" ? "bg-[#262626] text-white" : ""} `}
                                    />
                                </div>
                                <div className="grid gap-2">
                                    <Label>State</Label>
                                    <div className="flex gap-4">
                                        <div className="flex items-center space-x-2">
                                            <input
                                                type="radio"
                                                id="work"
                                                name="state"
                                                value="Work"
                                                checked={data.state === 'Work'}
                                                onChange={(e) => setData('state', e.target.value)}
                                            />
                                            <label htmlFor="work">Work</label>
                                        </div>
                                        <div className="flex items-center space-x-2">
                                            <input
                                                type="radio"
                                                id="not-work"
                                                name="state"
                                                value="Not Work"
                                                checked={data.state === 'Not Work'}
                                                onChange={(e) => setData('state', e.target.value)}
                                            />
                                            <label htmlFor="not-work">Not Work</label>
                                        </div>
                                    </div>

                                    <div className="grid gap-2">
                                        <label htmlFor="type">Equipment Type</label>
                                        <select
                                            id="type"
                                            value={data.equipment_type}
                                            onChange={(e) => setData('equipment_type', e.target.value)}
                                            className={`p-2 rounded-md  ${appearance === "dark" ? "bg-[#262626] text-white" : "border-2 border-gray-100"} `}
                                        >
                                            <option disabled selected value="">Select type</option>
                                            <option selected={data.equipment_type === "camera"} value="camera">Camera</option>
                                            <option selected={data.equipment_type === "son"} value="son">Son</option>
                                            <option selected={data.equipment_type === "lumiere"} value="lumiere">Lumiere</option>
                                            <option selected={data.equipment_type === "data/stockage"} value="data/stockage">Data/Stockage</option>
                                            <option selected={data.equipment_type === "podcast"} value="podcast">Podcast</option>
                                            <option selected={data.equipment_type === "other"} value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div className="grid gap-2">
                                    <Label htmlFor="edit-image">Image</Label>
                                    <Input
                                        id="image"
                                        type="file"
                                        accept="image/*"
                                        multiple
                                        onChange={(e) => setData('image', e.target.files)}
                                        className={`${appearance === "dark" ? "bg-[#262626] text-white" : ""} `}
                                    />
                                </div>
                            </div>
                            <DialogFooter>
                                <Button
                                    variant="outline"
                                    onClick={() => {
                                        setIsEditModalOpen(false);
                                        setCurrentEquipment(null);
                                        resetForm();
                                    }}
                                    className={`border-gray-700  ${appearance === "dark" ? " text-white" : ""} `}
                                >
                                    Cancel
                                </Button>
                                <Button disabled={processing} className="bg-yellow-500 text-black hover:bg-yellow-600">
                                    {processing ? 'Updating...' : 'Update'}
                                </Button>
                            </DialogFooter>
                        </form>

                    </DialogContent>
                </Dialog>

                {/* Delete Confirmation Modal */}
                <AlertDialog open={isDeleteModalOpen} onOpenChange={setIsDeleteModalOpen}>
                    <AlertDialogContent className={` ${appearance === "dark" ? "bg-[#171717]" : ""} `}>
                        <AlertDialogHeader>
                            <AlertDialogTitle>Are you sure you want to delete this equipment?</AlertDialogTitle>
                            <AlertDialogDescription className={`${appearance === "dark" ? "text-gray-400" : ""}`}>
                                This action cannot be undone. This will permanently delete the equipment from your database.
                            </AlertDialogDescription>
                        </AlertDialogHeader>
                        <AlertDialogFooter>
                            <AlertDialogCancel
                                className={` ${appearance === "dark" ? " text-white" : ""}`}
                                onClick={() => {
                                    setIsDeleteModalOpen(false);
                                    setCurrentEquipment(null);
                                }}
                            >
                                Cancel
                            </AlertDialogCancel>
                            <AlertDialogAction className="bg-red-500 text-white hover:bg-red-600" onClick={handleDeleteEquipment}>
                                Delete
                            </AlertDialogAction>
                        </AlertDialogFooter>
                    </AlertDialogContent>
                </AlertDialog>
            </div>
            <div className="mt-6 flex gap-2 justify-center">
    {equipments.links
        .filter(link => !isNaN(link.label)) 
        .map((link, index) => (
            <button
                key={index}
                disabled={!link.url}
                onClick={() => link.url && router.visit(link.url)}
                className={`px-3 py-1 border rounded-full ${
                    link.active ? ' text-alpha border-alpha font-bold' : ''
                }`}
                dangerouslySetInnerHTML={{ __html: link.label }}
            />
        ))}
</div>



        </AppLayout>
    );
}
