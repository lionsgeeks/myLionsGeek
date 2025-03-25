import { Head, useForm } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';

import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/auth-layout';
import { DotLottieReact } from '@lottiefiles/dotlottie-react';

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('login'), {
            onFinish: () => reset('password'),
        });
    };

    return (
        <AuthLayout >
            <Head title="Log in" />
            <div className="flex justify-center bg-[#2E2E2E] items-center w-[67vw] h-full gap-9  pr-10 rounded-lg">
                <div className="flex w-[33vw] h-[62vh] flex-col items-center rounded-lg justify-center gap-7 p-8">
                    <DotLottieReact
                        src="https://lottie.host/0da8275c-bf35-42c4-8b15-d8e3787ccd37/O6JB496Rd1.lottie"
                        loop
                        autoplay
                    />

                </div>
                <div className='w-[45%] py-7'>
                    <div className="mb-8 flex flex-col justify-center items-center">
                        <img src="https://mylionsgeek.ma/logo1.png" alt="logo" className="w-[70px] h-[70px] invert mb-3"
                            loading="lazy" />
                        <h1 className="text-2xl text-white mb-2">Welcome</h1>
                        <h4 className="text-gray-400 font-light ">Please Enter Your Information</h4>
                    </div>
                    <form className="flex flex-col gap-6" onSubmit={submit}>
                        <div className="grid gap-6">
                            <div className="grid gap-2">
                                <Label htmlFor="email" className='text-gray-300'>Email address</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    required
                                    autoFocus
                                    tabIndex={1}
                                    autoComplete="email"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    placeholder="email@example.com"
                                    className='text-white'
                                />
                                <InputError message={errors.email} />
                            </div>

                            <div className="grid gap-2">
                                <div className="flex items-center">
                                    <Label htmlFor="password" className='text-gray-300' >Password</Label>
                                    {canResetPassword && (
                                        <TextLink href={route('password.request')} className="ml-auto text-sm text-gray-300" tabIndex={5}>
                                            Forgot password?
                                        </TextLink>
                                    )}
                                </div>
                                <Input
                                    id="password"
                                    type="password"
                                    required
                                    tabIndex={2}
                                    autoComplete="current-password"
                                    value={data.password}
                                    onChange={(e) => setData('password', e.target.value)}
                                    placeholder="Password"
                                    className='text-white'
                                />
                                <InputError message={errors.password} />
                            </div>

                            <div className="flex items-center space-x-3">
                                <Checkbox
                                    id="remember"
                                    name="remember"
                                    checked={data.remember}
                                    onClick={() => setData('remember', !data.remember)}
                                    tabIndex={3}
                                />
                                <Label htmlFor="remember" className='text-gray-300'>Remember me</Label>
                            </div>

                            <Button type="submit" className="mt-4 w-full bg-[#fee814] text-black" tabIndex={4} disabled={processing}>
                                {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                                Log in
                            </Button>
                        </div>

                        <div className="text-center text-gray-300 text-sm">
                            Don't have an account?{' '}
                            <TextLink href={route('register')} tabIndex={5} className='text-[#fee814]'>
                                Sign up
                            </TextLink>
                        </div>
                    </form>

                </div>

                {status && <div className="mb-4 text-center text-sm font-medium text-green-600">{status}</div>}
            </div>

        </AuthLayout>
    );
}
