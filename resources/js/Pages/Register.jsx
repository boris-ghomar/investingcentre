import React from 'react';
import {Box, Button, Container, Grid2, TextField} from "@mui/material";
import {usePage} from "@inertiajs/inertia-react";
import { useForm } from '@inertiajs/react'

const Register = () => {
    const {props: {email}, url} = usePage();
    const {data, setData, post, processing, errors} = useForm({
        first_name: "",
        last_name: "",
        password: "",
        password_confirmation: "",
        phone: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();

        post("/register");
    };

    return (
        <Container maxWidth="sm">
            <Box className="custom-container">
                <form onSubmit={handleSubmit}>
                    <Grid2 container spacing={2} padding={2}>
                        <Grid2 size={{xs: 12, sm: 6}}>
                            <TextField
                                fullWidth
                                label="First name"
                                variant="outlined"
                                required
                                value={data.first_name}
                                autoComplete="first_name"
                                helperText={errors.first_name ?? ""}
                                error={!!errors.first_name}
                                onChange={(e) => setData("first_name", e.target.value)}
                            />
                        </Grid2>
                        <Grid2 size={{xs: 12, sm: 6}}>
                            <TextField
                                fullWidth
                                label="Last name"
                                variant="outlined"
                                required
                                value={data.last_name}
                                autoComplete="last_name"
                                helperText={errors.last_name ?? ""}
                                error={!!errors.last_name}
                                onChange={(e) => setData("last_name", e.target.value)}
                            />
                        </Grid2>
                        <Grid2 size={12}>
                            <TextField
                                fullWidth
                                variant="outlined"
                                disabled
                                type="email"
                                label="Email"
                                autoComplete="email"
                                defaultValue={email}
                            />
                        </Grid2>
                        <Grid2 size={{xs: 12, sm: 6}}>
                            <TextField
                                fullWidth
                                label="Password"
                                variant="outlined"
                                type="password"
                                autoComplete="current-password"
                                required
                                error={!!errors.password || !!errors.password_confirmation}
                                helperText={errors.password ?? errors.password_confirmation ?? ""}
                                value={data.password}
                                onChange={(e) => setData("password", e.target.value)}
                            />
                        </Grid2>
                        <Grid2 size={{xs: 12, sm: 6}}>
                            <TextField
                                fullWidth
                                label="Repeat Password"
                                variant="outlined"
                                type="password"
                                autoComplete="current-password"
                                error={!!errors.password_confirmation}
                                helperText={errors.password_confirmation ?? ""}
                                required
                                value={data.password_confirmation}
                                onChange={(e) => setData("password_confirmation", e.target.value)}
                            />
                        </Grid2>
                        <Grid2 size={12}>
                            <TextField
                                fullWidth
                                label="Phone Number"
                                autoComplete="phone"
                                variant="outlined"
                                error={!!errors.phone}
                                helperText={errors.phone ?? ""}
                                required
                                value={data.phone}
                                onChange={(e) => setData("phone", e.target.value)}
                            />
                        </Grid2>
                        <Grid2 size={12}>
                            <Button disabled={processing} variant="contained" type="submit" fullWidth>
                                Complete registration
                            </Button>
                        </Grid2>
                    </Grid2>
                </form>
            </Box>
        </Container>
    );
}

export default Register;
