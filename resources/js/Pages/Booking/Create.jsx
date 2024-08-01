import React, { useState } from "react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Checkbox from "@/Components/Checkbox";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Create({ auth }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: "",
        title: "",
        name: "",
        date: "",
    });

    const submit = (e) => {
        e.preventDefault();

        post(route("booking.store"));
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Book" />

            <div className="py-12">
                <div className="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden p-6 shadow-sm sm:rounded-lg">
                        <form onSubmit={submit}>
                            <div className="w-full flex flex-col gap-2 md:flex-row">
                                <div className="w-full md:w-1/2">
                                    <InputLabel htmlFor="title" value="Title" />

                                    <TextInput
                                        id="title"
                                        type="text"
                                        name="title"
                                        value={data.title}
                                        className="mt-1 block w-full"
                                        isFocused={true}
                                        onChange={(e) =>
                                            setData("title", e.target.value)
                                        }
                                    />

                                    <InputError
                                        message={errors.title}
                                        className="mt-2"
                                    />
                                </div>

                                <div className="w-full md:w-1/2">
                                    <InputLabel htmlFor="date" value="Date" />

                                    <TextInput
                                        id="date"
                                        type="date"
                                        name="date"
                                        value={data.date}
                                        className="mt-1 block w-full"
                                        onChange={(e) =>
                                            setData("date", e.target.value)
                                        }
                                    />

                                    <InputError
                                        message={errors.date}
                                        className="mt-2"
                                    />
                                </div>
                            </div>

                            <div className="flex items-center justify-center mt-4">
                                <PrimaryButton
                                    className="ms-4"
                                    disabled={processing}
                                >
                                    Book
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
