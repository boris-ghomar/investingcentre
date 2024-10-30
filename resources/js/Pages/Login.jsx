import React from 'react';
import {Box, Button, Checkbox, Container, FormControlLabel, Grid2, TextField} from "@mui/material";
import {usePage} from "@inertiajs/inertia-react";
import { useForm } from '@inertiajs/react'

const Login = () => {
    const {props: {viaEmail}} = usePage();

    const {data, setData, post, processing, errors} = useForm({
        email: viaEmail ?? "",
        password: "",
        remember: false,
    })

    const handleSubmit = (e) => {
        e.preventDefault();

        post("/login");
    };

    return (
        <Container maxWidth="sm">
            <Box className="custom-container">
                <form onSubmit={handleSubmit}>
                    <Grid2 container spacing={2} padding={2}>
                        <Grid2 size={12}>
                            <TextField
                                fullWidth
                                label="Email"
                                variant="outlined"
                                disabled={!!viaEmail}
                                autoFocus={!!!viaEmail}
                                required
                                type="email"
                                value={data.email}
                                autoComplete="email"
                                helperText={errors.email ?? ""}
                                error={!!errors.email}
                                onChange={(e) => setData("email", e.target.value)}
                            />
                        </Grid2>
                        <Grid2 size={12}>
                            <TextField
                                fullWidth
                                label="Password"
                                type="password"
                                autoComplete="current-password"
                                variant="outlined"
                                autoFocus={!!viaEmail}
                                required
                                error={!!errors.password}
                                helperText={errors.password ?? ""}
                                value={data.password}
                                onChange={(e) => setData("password", e.target.value)}
                            />
                        </Grid2>
                        <Grid2 size={12}>
                            <FormControlLabel
                                control={<Checkbox value={data.remember} onChange={(e) => setData("remember", e.target.value)} />}
                                label="Remember me"
                            />
                        </Grid2>
                        <Grid2 size={12}>
                            <Button disabled={processing} variant="contained" type="submit" fullWidth>
                                Login
                            </Button>
                        </Grid2>
                    </Grid2>
                </form>
            </Box>
        </Container>
    );
}

export default Login;
