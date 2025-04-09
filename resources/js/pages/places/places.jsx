import React, { useState } from 'react';
import { useForm, usePage, router } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';
import { Dialog, DialogTrigger, DialogContent, DialogTitle,  } from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem, } from '@/components/ui/select';
import { Plus, Upload } from 'lucide-react';
import Carousel from '../../components/Carousel';
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle, } from '@/components/ui/alert-dialog';
import { useAppearance } from '@/hooks/use-appearance';

const Places = () => {
    const { places } = usePage().props;
    const [isEditModalOpen, setIsEditModalOpen] = useState(false);
    const [openDelete, setOpenDelete] = useState(false);
    const [open, setOpen] = useState(false);
    const [currentplaces, setCurrentPlaces] = useState(null);
    const [searchQuery, setSearchQuery] = useState("");
    const [filterType, setFilterType] = useState('all');
    const { appearance } = useAppearance();

    const resetFilters = () => {
        setSearchQuery('');
        setFilterType('all');
    };

    const filteredPlaces = places.data.filter((place) => {
        const search = searchQuery.toLowerCase();
        const matchesSearch = place.name.toLowerCase().includes(search);
        const matchesType = filterType === 'all' || place.place_type === filterType;

        return matchesSearch && matchesType;
    });


    const handleEditSubmit = (e) => {
        e.preventDefault();
        console.log(currentplaces);

        if (currentplaces) {
            post(route('places.update', currentplaces), {
                _method: 'put',
                data: data,
            })

            resetForm();
        }
    }


    const openEditModal = (place) => {
        setCurrentPlaces(place)
        setData({
            name: place.name,
            place_type: place.place_type,
            state: place.state.toString(),
            images: null,
        });

        setIsEditModalOpen(true);
    };
    const { data, setData, post, errors, reset, } = useForm({
        name: '',
        place_type: '',
        state: '1',
        images: null
    });

    const resetForm = () => {
        setData({
            name: '',
            place_type: '',
            state: '1',
            images: null
        });
    };
    const breadcrumbs = [
        {
            title: 'places',
            href: '/places',
        },
    ];

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('places.store'), {
            onFinish: () => reset(),
        });
        console.log(data);
        resetForm();
        setOpen(false);

    };


    const handleDelete = () => {
        if (currentplaces) {
            router.delete(route('places.destroy', currentplaces.id),);
        }
    };

    const openDeleteModal = (place) => {
        setCurrentPlaces(place);
        setOpenDelete(true);
    };
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="places" />
            <div className="min-h-screen p-6">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
                <h1 className="text-3xl font-bold pb-8">Places</h1>

                <div className=" mb-12 flex gap-3">
                    <Input
                        type="text"
                        value={searchQuery}
                        placeholder="Search by Name"
                        onChange={(e) => setSearchQuery(e.target.value)}
                        className="w-80"
                    />

                    <Select value={filterType} onValueChange={(value) => setFilterType(value)}>
                        <SelectTrigger className="w-80 focus:border-alpha">
                            <SelectValue placeholder="Select type" />
                        </SelectTrigger>
                        <SelectContent className="border-gray-300 ">
                            <SelectItem value="all"><Select:disabled class="text-gray-500">Select type</Select:disabled></SelectItem>
                            <SelectItem value="studios">Studios</SelectItem>
                            <SelectItem value="co_work">Co-Work</SelectItem>
                            <SelectItem value="meeting_room">Meeting Room</SelectItem>
                        </SelectContent>
                    </Select>

                    <Button
                        onClick={resetFilters} className="px-4 py-2 bg-alpha text-black font-semibold rounded-md text-sm transition hover:bg-white  hover:border-2 hover:border-alpha">
                        Reset Filters
                    </Button>
                </div>

                <div className="">
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">

                        <Dialog open={open} onOpenChange={setOpen}>
                            <DialogTrigger asChild>
                                <div className="border-2 border-dashed border-gray-400 rounded-xl h-[300px] flex flex-col items-center justify-center cursor-pointer hover:border-alpha transition-colors">
                                    <div className="flex flex-col items-center">
                                        <Plus className="w-12 h-12 mb-4" />
                                        <span className="font-medium">Add Place</span>
                                    </div>
                                </div>
                            </DialogTrigger>

                            <DialogContent className="border max-w-md p-0 shadow-xl shadow-black/20 dialog-content">
                                <div className=" py-4 px-6 border-b border-gray-700">
                                    <DialogTitle className="text-xl font-bold ">Create New Places</DialogTitle>
                                </div>

                                <div className="p-6">
                                    <form encType="multipart/form-data" onSubmit={handleSubmit} className="space-y-5">
                                        <div className="space-y-2">
                                            <Label htmlFor="name" className="">
                                                Name
                                            </Label>
                                            <Input
                                                id="name"
                                                value={data.name}
                                                onChange={(e) => setData("name", e.target.value)}
                                                className=" border-gray-700 focus:border-alpha "
                                                placeholder="Enter gallery name"
                                            />
                                            {errors.name && <p className="text-sm text-red-400 mt-1">{errors.name}</p>}
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="place_type" className="">
                                                Type
                                            </Label>
                                            <Select value={data.place_type} onValueChange={(value) => setData("place_type", value)}>
                                                <SelectTrigger className=" border-gray-700 focus:border-alpha ">
                                                    <SelectValue placeholder="Select type" />
                                                </SelectTrigger>
                                                <SelectContent className=" border-gray-700 ">
                                                    <SelectItem value="studios">Studios</SelectItem>
                                                    <SelectItem value="co_work">Co-Work</SelectItem>
                                                    <SelectItem value="meeting_room">Meeting Room</SelectItem>
                                                </SelectContent>
                                            </Select>
                                            {errors.place_type && <p className="text-sm text-red-400 mt-1">{errors.place_type}</p>}
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="state" className="">
                                                Status
                                            </Label>
                                            <Select value={data.state} onValueChange={(value) => setData("state", value)}>
                                                <SelectTrigger className=" border-gray-700 focus:border-alpha ">
                                                    <SelectValue placeholder="Select status" />
                                                </SelectTrigger>
                                                <SelectContent className=" border-gray-700 ">
                                                    <SelectItem value="1">Active</SelectItem>
                                                    <SelectItem value="0">Inactive</SelectItem>
                                                </SelectContent>
                                            </Select>
                                        </div>

                                        <div className="space-y-3">
                                            <Label htmlFor="images" className="">
                                                Gallery Images
                                            </Label>
                                            <div className="flex items-center justify-center w-full mt-1">
                                                <Input
                                                    id="images"
                                                    type="file"
                                                    accept="image/*"
                                                    multiple onChange={(e) => setData('images', e.target.files)}
                                                    className=" border-gray-700 focus:border-alpha "

                                                />
                                            </div>
                                            {errors.images && <p className="text-sm text-red-400 mt-1">{errors.images}</p>}


                                        </div>

                                        <div className="flex gap-3 pt-2">
                                            <Button
                                                type="button"
                                                variant="outline"
                                                onClick={() => setOpen(false)}
                                                className="flex-1 bg-transparent hover:bg-gray-800  border-gray-600"
                                            >
                                                Cancel
                                            </Button>
                                            <Button type="submit" className="flex-1 bg-alpha hover:bg-yellow-600 text-black font-medium">
                                                Create Gallery
                                            </Button>
                                        </div>
                                    </form>
                                </div>
                            </DialogContent>
                        </Dialog>

                        <Dialog open={isEditModalOpen} onOpenChange={setIsEditModalOpen}>
                            <DialogContent className="border max-w-md p-0 shadow-xl shadow-black/20 dialog-content">
                                <div className="py-4 px-6 border-b border-gray-700">
                                    <DialogTitle className="text-xl font-bold">Edit Place</DialogTitle>
                                </div>

                                <div className="p-6">
                                    <form encType="multipart/form-data" onSubmit={handleEditSubmit} className="space-y-5">
                                        <div className="space-y-2">
                                            <Label htmlFor="edit-name">Name</Label>
                                            <Input
                                                id="edit-name"
                                                value={data.name}
                                                onChange={(e) => setData("name", e.target.value)}
                                                className="border-gray-700 focus:border-alpha"
                                                placeholder="Enter place name"
                                            />
                                            {errors.name && <p className="text-sm text-red-400">{errors.name}</p>}
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="edit-place_type">Type</Label>
                                            <Select
                                                value={data.place_type}
                                                onValueChange={(value) => setData("place_type", value)}
                                            >
                                                <SelectTrigger className="border-gray-700 focus:border-alpha">
                                                    <SelectValue placeholder="Select type" />
                                                </SelectTrigger>
                                                <SelectContent className="border-gray-700">
                                                    <SelectItem value="studios">Studios</SelectItem>
                                                    <SelectItem value="co_work">Co-Work</SelectItem>
                                                    <SelectItem value="meeting_room">Meeting Room</SelectItem>
                                                </SelectContent>
                                            </Select>
                                            {errors.place_type && <p className="text-sm text-red-400">{errors.place_type}</p>}
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="edit-state">Status</Label>
                                            <Select
                                                value={data.state}
                                                onValueChange={(value) => setData("state", value)}
                                            >
                                                <SelectTrigger className="border-gray-700 focus:border-alpha">
                                                    <SelectValue placeholder="Select status" />
                                                </SelectTrigger>
                                                <SelectContent className="border-gray-700">
                                                    <SelectItem value="1">Active</SelectItem>
                                                    <SelectItem value="0">Inactive</SelectItem>
                                                </SelectContent>
                                            </Select>
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="edit-images">Gallery Images</Label>
                                            <Input
                                                id="edit-images"
                                                type="file"
                                                accept="image/*"
                                                multiple
                                                onChange={(e) => setData('images', e.target.files)}
                                                className="border-gray-700 focus:border-alpha"
                                            />
                                            {errors.images && <p className="text-sm text-red-400">{errors.images}</p>}
                                        </div>

                                        <div className="flex gap-3 pt-2">
                                            <Button
                                                type="button"
                                                variant="outline"
                                                onClick={() => {
                                                    setIsEditModalOpen(false);
                                                    resetForm();
                                                }}
                                                className="flex-1 bg-transparent hover:bg-gray-800 border-gray-600"
                                            >
                                                Cancel
                                            </Button>
                                            <Button
                                                type="submit"
                                                className="flex-1 bg-yellow-500 hover:bg-yellow-600 text-black font-medium"
                                            >
                                                Update Place
                                            </Button>
                                        </div>
                                    </form>
                                </div>
                            </DialogContent>
                        </Dialog>

                        <AlertDialog open={openDelete} onOpenChange={setOpenDelete}>
                            <AlertDialogContent>
                                <AlertDialogHeader>
                                    <AlertDialogTitle>Are you sure you want to delete this place?</AlertDialogTitle>
                                    <AlertDialogDescription>
                                        This action cannot be undone. This will permanently delete the place from your database.
                                    </AlertDialogDescription>
                                </AlertDialogHeader>
                                <AlertDialogFooter>
                                    <AlertDialogCancel onClick={() => setOpenDelete(false)}>
                                        Cancel
                                    </AlertDialogCancel>
                                    <AlertDialogAction
                                        className="bg-red-500 text-white hover:bg-red-600"
                                        onClick={() => handleDelete()}
                                    >
                                        Delete
                                    </AlertDialogAction>
                                </AlertDialogFooter>
                            </AlertDialogContent>
                        </AlertDialog>

                        {filteredPlaces?.map((place) => (
                            <div key={place.id} className={`relative border col-span-1  rounded-xl overflow-hidden ${appearance === "dark" ? "border-[#2E2E2E]" : "border-gray-200"}`}>
                                <div className="relative h-[205px] overflow-hidden">
                                    {place.images && place.images.length > 1 ? (
                                        <div className="relative h-full">
                                            <Carousel name="places" images={place.images} />
                                            <h1 className="absolute top-2 right-3 capitalize px-3 py-1 rounded-lg bg-[#fee7147c] text-sm font-semibold z-10">
                                                {place.place_type}
                                            </h1>
                                        </div>) : place.images && place.images.length === 1 ? (
                                            <img
                                                src={`/storage/images/places/${place.images[0].path}`}
                                                alt={place.name}
                                                className="w-full h-full object-cover"
                                            />

                                        ) : (
                                        <div className="w-full h-full flex items-center justify-center">
                                            <span>No Image</span>
                                        </div>
                                    )}
                                </div>

                                <div className={`flex justify-between items-center px-4 py-4 rounded-b-lg ${appearance === "dark" ? "bg-[#2E2E2E] " : "bg-gray-100"}`}>
                                    <h1 className="absolute top-2 right-3 capitalize px-3 py-1 rounded-lg bg-[#fee7147c] text-sm font-semibold">
                                        {place.place_type}
                                    </h1>

                                    <div>
                                        <h3>{place.name}</h3>
                                        <a href="#" className="block text-alpha mt-2 text-sm hover:underline">See Gallery</a>
                                    </div>

                                    <div className="flex flex-col space-y-2">
                                        <button
                                            className="text-gray-500 px-2 py-1 hover:text-blue-700 transition-colors duration-300"
                                            onClick={() => openEditModal(place)}
                                        >
                                            <i className="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button
                                            onClick={() => openDeleteModal(place)}
                                            className="text-gray-500 hover:text-red-700 transition-colors duration-300"
                                        >
                                            <i className="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        ))}

                    </div>
                </div>
            </div>
            <div className="mt-6 flex gap-2 justify-center">
    {places.links
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
};

export default Places;